<?php

declare(strict_types=1);

use Goutte\Client;
use Nette\PhpGenerator\Dumper;
use Nette\PhpGenerator\Literal;
use Nette\PhpGenerator\PhpFile;
use Nette\Utils\FileSystem;
use Setono\GoogleAnalyticsMeasurementProtocol\Event\Event;
use Setono\GoogleAnalyticsMeasurementProtocol\Event\EventInterface;
use Setono\GoogleAnalyticsMeasurementProtocol\Event\EventParameters;
use Setono\GoogleAnalyticsMeasurementProtocol\Event\EventTestCase;
use Setono\GoogleAnalyticsMeasurementProtocol\Event\ItemsAwareEventParametersInterface;
use Setono\GoogleAnalyticsMeasurementProtocol\Event\ItemsAwareEventParametersTrait;
use Stringizer\Stringizer;
use Symfony\Component\DomCrawler\Crawler;

require_once 'vendor/autoload.php';

$eventReflectionClass = new ReflectionClass(EventInterface::class);
$eventNamespace = $eventReflectionClass->getNamespaceName();
$eventDir = dirname($eventReflectionClass->getFileName());
$eventTestDir = str_replace('src', 'tests', $eventDir);
$events = get_events();

foreach ($events as $event) {
    $eventName = new Stringizer($event['name']);
    $eventClassName = sprintf('%sEvent', $eventName->camelize()->uppercaseFirst(true)->getString());

    generate_event_class($event, $eventClassName, $eventNamespace, $eventDir);

    if (isset($event['params'])) {
        $eventParamsClassName = sprintf('%sParameters', $eventClassName);
        generate_event_parameters_class($event, $eventParamsClassName, $eventNamespace, $eventDir);
    }

    generate_event_test_class($event, $eventClassName, $eventNamespace, $eventTestDir);
}

function get_events(): array
{
    $cacheFilename = 'bin/events.php';

    if (file_exists($cacheFilename)) {
        return require $cacheFilename;
    }

    $url = 'https://developers.google.com/analytics/devguides/collection/protocol/ga4/reference/events';
    $client = new Client();
    $crawler = $client->request('GET', $url);

    $events = $crawler
        ->filter('h2')
        ->each(function (Crawler $node) {
            $name = $node->attr('data-text');
            $description = $node->nextAll()->first()->text();

            if ($node->nextAll()->eq(2)->matches('table')) {
                $params = $node
                    ->nextAll()
                    ->eq(2)
                    ->filter('tr')
                    ->slice(1)
                    ->each(function (Crawler $node) {
                        return $node
                            ->children()
                            ->each(function (Crawler $node) {
                                return $node->text();
                            });
                    });
            }

            return compact('name', 'description', 'params');
        });

    $dumper = new Dumper();
    file_put_contents($cacheFilename, sprintf("<?php\n\nreturn %s;\n", $dumper->dump($events)));

    return $events;
}

function generate_event_class(array $event, string $className, string $namespaceName, string $dir): void
{
    $file = new PhpFile();
    $file->setStrictTypes();
    $namespace = $file->addNamespace($namespaceName);

    $class = $namespace->addClass($className);
    $class->setFinal(true);
    $class->addExtend(Event::class);

    $nameProperty = $class->addProperty('name', $event['name']);
    $nameProperty->setProtected();
//    $nameProperty->setType('string');
    $nameProperty->addComment('@var string');
    $nameProperty->addComment($event['description']);

    if (isset($event['params'])) {
        $paramsClassName = sprintf('%sParameters', $className);
        $class->addComment(sprintf('@property %s $parameters', $paramsClassName));

        $constructor = $class->addMethod('__construct');
        $constructor->addBody(sprintf('$this->parameters = new %s();', $paramsClassName));
    }

    write_file($dir, $className, $file);
}

function generate_event_parameters_class(array $event, string $className, string $namespaceName, string $dir): void
{
    $file = new PhpFile();
    $file->setStrictTypes(true);

    $classNamespace = $file->addNamespace($namespaceName);

    $class = $classNamespace->addClass($className);
    $class->setFinal(true);
    $class->addExtend(EventParameters::class);

    foreach ($event['params'] as $param) {
        if ($param[0] === 'items') {
            $class->addImplement(ItemsAwareEventParametersInterface::class);
            $class->addTrait(ItemsAwareEventParametersTrait::class);
        } else {
            $property = $class->addProperty((new Stringizer($param['0']))->camelize()->getString());
            $property->setPublic();
//            $property->setType(get_type($param));
            $property->addComment(sprintf('@var %s', get_type($param)));
            $property->addComment($param[4]);
            $property->addComment(sprintf('Required: %s', $param[2]));
            $property->addComment(sprintf('Example: %s', $param[3]));
        }
    }

    write_file($dir, $className, $file);
}

function generate_event_test_class(array $event, string $eventClassName, string $namespaceName, string $dir): void
{
    $testClassName = sprintf('%sTest', $eventClassName);

    $file = new PhpFile();
    $file->setStrictTypes();
    $namespace = $file->addNamespace($namespaceName);

    $class = $namespace->addClass($testClassName);
    $class->setFinal(true);
    $class->addExtend(EventTestCase::class);

    $arrayTestMethod = $class->addMethod('it_returns_array');
    $arrayTestMethod->addComment('@test');
    $arrayTestMethod->addComment('@dataProvider exampleEventProvider');
    $arrayTestMethod->setReturnType('void');
    $eventParam = $arrayTestMethod->addParameter('event');
    $eventParam->setType(EventInterface::class);

    $requestTestMethod = $class->addMethod('it_yields_a_valid_request');
    $requestTestMethod->addComment('@test');
    $requestTestMethod->addComment('@dataProvider exampleEventProvider');
    $requestTestMethod->setReturnType('void');
    $requestTestMethod->setParameters([$eventParam]);
    $requestTestMethod->setBody('$this->assertValidRequest($event);');

    $providerMethod = $class->addMethod('exampleEventProvider');
    $providerMethod->setReturnType('iterable');
    $providerMethod->addBody('$event = new ?();', [new Literal($eventClassName)]);

    $assert = [
        'name' => $event['name'],
    ];
    $itemsCodeFragment = '';
    $dumper = new Nette\PhpGenerator\Dumper();

    if (isset($event['params'])) {
        $assert['params'] = [];

        foreach ($event['params'] as $param) {
            $propertyName = (new Stringizer($param['0']))->camelize()->getString();

            if ($propertyName === 'items') {
                $itemsCodeFragment = $dumper->format("\$item = new GenericItemEventParameters();\n") .
                    $dumper->format("\$item->itemId = ?;\n\n", 'SKU_12345') .
                    $dumper->format("\$event->parameters->addItem(\$item);\n");

                continue;
            }

            $type = get_type($param);

            if ($type === 'int' || $type === 'float') {
                $assert['params'][$param[0]] = ($type === 'float' ? (float) $param[3] : (int) $param[3]);
            } else {
                $assert['params'][$param[0]] = $param[3];
            }

            $providerMethod->addBody('$event->parameters->? = ?;', [$propertyName, $assert['params'][$param[0]]]);
        }

        if ($itemsCodeFragment !== '') {
            $providerMethod->addBody("\n$itemsCodeFragment");
            $assert['params']['items'] = [['item_id' => 'SKU_12345']];
        }
    }

    $arrayTestMethod->setBody('self::assertSame(?, $event->toArray());', [new Literal($dumper->dump($assert, 10))]);
    $providerMethod->addBody('return [[$event]];');

    write_file($dir, $testClassName, $file);
}

function get_type(array $param): ?string
{
    if (false !== strpos($param[1], 'string')) {
        return 'string';
    }

    if (false !== strpos($param[1], 'number')) {
        if (false !== strpos($param[3], '.')) {
            return 'float';
        }

        return 'int';
    }

    return null;
}

function write_file(string $dir, string $name, PhpFile $file): void
{
    file_put_contents(FileSystem::joinPaths($dir, $name . '.php'), (new Nette\PhpGenerator\PsrPrinter())->printFile($file));
}
