<?php

declare(strict_types=1);

use Goutte\Client;
use Nette\PhpGenerator\ClassType;
use Nette\PhpGenerator\Dumper;
use Nette\PhpGenerator\Literal;
use Nette\PhpGenerator\PhpFile;
use Nette\PhpGenerator\Property;
use Nette\Utils\FileSystem;
use Setono\GoogleAnalyticsMeasurementProtocol\Event;
use Setono\GoogleAnalyticsMeasurementProtocol\EventInterface;
use Setono\GoogleAnalyticsMeasurementProtocol\EventTestCase;
use Setono\GoogleAnalyticsMeasurementProtocol\ItemTrait;
use Setono\GoogleAnalyticsMeasurementProtocol\Parameters;
use Setono\GoogleAnalyticsMeasurementProtocol\ItemsAwareInterface;
use Setono\GoogleAnalyticsMeasurementProtocol\ItemsAwareTrait;
use Stringizer\Stringizer;
use Stringizer\Transformers\CamelToSnake;
use Symfony\Component\DomCrawler\Crawler;

require_once 'vendor/autoload.php';

$eventNamespace = 'Setono\GoogleAnalyticsMeasurementProtocol\Event';
$eventDir = FileSystem::joinPaths(dirname(__DIR__), 'src', 'Event');
$eventTestDir = str_replace('src', 'tests', $eventDir);
$events = get_events();

$itemTraitNamespace = 'Setono\GoogleAnalyticsMeasurementProtocol';
$itemTraitDir = FileSystem::joinPaths(dirname(__DIR__), 'src');
$commonItemParams = get_common_item_params($events);
generate_common_item_parameters_class($commonItemParams, 'ItemTrait', $itemTraitNamespace, $itemTraitDir);

foreach ($events as $event) {
    $eventName = new Stringizer($event['name']);
    $eventClassName = sprintf('%s', $eventName->camelize()->uppercaseFirst(true)->getString());

    generate_event_class($event, $eventClassName, $eventNamespace, $eventDir);

    if (isset($event['params'])) {
        $eventParamsClassName = sprintf('%sParameters', $eventClassName);
        generate_event_parameters_class($event, $eventParamsClassName, $eventNamespace, $eventDir);
    }

    if (isset($event['item'])) {
        $itemParamsClassName = sprintf('%sItem', $eventClassName);
        generate_item_parameters_class($event, $commonItemParams, $itemParamsClassName, $eventNamespace, $eventDir);
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
                $params = html_table_to_array($node->nextAll()->eq(2));

                $hasItems = array_reduce($params, static function (bool $hasItems, array $item): bool {
                    return $hasItems || $item['name'] === 'items';
                }, false);

                if ($hasItems) {
                    $itemNode = $node->nextAll()->filter("h4[id$=_item]")->first();

                    if ($itemNode->count() === 1) {
                        $item = html_table_to_array($itemNode->nextAll()->first());
                    }
                }
            }

            return compact('name', 'description', 'params', 'item');
        });

    $dumper = new Dumper();
    file_put_contents($cacheFilename, sprintf("<?php\n\nreturn %s;\n", $dumper->dump($events)));

    return $events;
}

function html_table_to_array(Crawler $crawler): array
{
    $rows = $crawler
        ->filter('tr')
        ->each(function (Crawler $node) {
            return $node
                ->children()
                ->each(function (Crawler $node) {
                    return $node->text();
                });
        });

    $rows = array_filter($rows, static function (array $row): bool {
        return !empty($row);
    });

    $keys = array_map(static function (string $key): string {
        $key = (new Stringizer($key))->camelize()->camelToSnake()->getString();

        return $key === 'example_value' ? 'example' : $key;
    }, $rows[0]);

    return array_map(static function (array $row) use ($keys): array {
        return array_combine($keys, $row);
    }, array_slice($rows, 1));
}

function get_common_item_params(array $events): array
{
    $allFields = [];
    $fieldsToItemsCount = [];
    $itemsCount = 0;

    foreach ($events as $event) {
        if (!isset($event['item'])) {
            continue;
        }

        ++$itemsCount;

        foreach ($event['item'] as $field) {
            if (isset($fieldsToItemsCount[$field['name']])) {
                ++$fieldsToItemsCount[$field['name']];
            } else {
                $fieldsToItemsCount[$field['name']] = 1;
                $allFields[$field['name']] = $field;
            }
        }
    }

    return array_intersect_key(
        $allFields,
        array_filter(
            $fieldsToItemsCount,
            static function (int $count) use ($itemsCount): bool {
                return $count === $itemsCount;
            }
        )
    );
}

function generate_event_class(array $event, string $className, string $namespaceName, string $dir): void
{
    $file = new PhpFile();
    $file->setStrictTypes();
    $namespace = $file->addNamespace($namespaceName);
    $namespace->addUse(Event::class);

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
    $class->addExtend(Parameters::class);
    $classNamespace->addUse(Parameters::class);

    foreach ($event['params'] as $param) {
        if ($param['name'] === 'items') {
            $class->addImplement(ItemsAwareInterface::class);
            $class->addTrait(ItemsAwareTrait::class);
            $classNamespace->addUse(ItemsAwareInterface::class);
            $classNamespace->addUse(ItemsAwareTrait::class);
        } else {
            add_param_as_property($class, $param);
        }
    }

    write_file($dir, $className, $file);
}

function generate_item_parameters_class(array $event, array $commonParams, string $className, string $namespaceName, string $dir): void
{
    $file = new PhpFile();
    $file->setStrictTypes(true);

    $classNamespace = $file->addNamespace($namespaceName);

    $class = $classNamespace->addClass($className);
    $class->setFinal(true);
    $class->addExtend(Parameters::class);
    $class->addTrait(ItemTrait::class);
    $classNamespace->addUse(Parameters::class);
    $classNamespace->addUse(ItemTrait::class);

    foreach ($event['item'] as $param) {
        if (isset($commonParams[$param['name']])) {
            continue;
        }

        add_param_as_property($class, $param);
    }

    write_file($dir, $className, $file);
}

function generate_common_item_parameters_class(array $params, string $className, string $namespaceName, string $dir): void
{
    $file = new PhpFile();
    $file->setStrictTypes(true);

    $classNamespace = $file->addNamespace($namespaceName);

    $class = $classNamespace->addTrait($className);

    foreach ($params as $param) {
        add_param_as_property($class, $param);
    }

    write_file($dir, $className, $file);
}

function add_param_as_property(ClassType $class, array $data): Property
{
    $property = $class->addProperty((new Stringizer($data['name']))->camelize()->getString());
    $property->setPublic();
    $property->addComment(sprintf('@var %s', get_type($data)));
    $property->addComment($data['description']);
    $property->addComment(sprintf('Required: %s', $data['required']));
    $property->addComment(sprintf('Example: %s', $data['example']));

    return $property;
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
    $namespace->addUse(EventTestCase::class);

    $arrayTestMethod = $class->addMethod('it_returns_array');
    $arrayTestMethod->addComment('@test');
    $arrayTestMethod->addComment('@dataProvider exampleEventProvider');
    $arrayTestMethod->setReturnType('void');
    $eventParam = $arrayTestMethod->addParameter('event');
    $eventParam->setType(EventInterface::class);
    $namespace->addUse(EventInterface::class);


    $requestTestMethod = $class->addMethod('it_yields_a_valid_request');
    $requestTestMethod->addComment('@test');
    $requestTestMethod->addComment('@dataProvider exampleEventProvider');
    $requestTestMethod->setReturnType('void');
    $requestTestMethod->setParameters([$eventParam]);
    $requestTestMethod->setBody('$this->assertValidRequest($event);');

    $providerMethod = $class->addMethod('exampleEventProvider');
    $providerMethod->setReturnType('iterable');
    $providerMethod->addBody('$event = new ?();', [new Literal($eventClassName)]);
    $namespace->addUse($namespaceName . '\\' . $eventClassName);

    $assert = [
        'name' => $event['name'],
    ];

    $dumper = new Nette\PhpGenerator\Dumper();

    if (isset($event['params'])) {
        $assert['params'] = [];
        $itemProps = [];

        foreach ($event['params'] as $param) {
            if ($param['name'] === 'items' && isset($event['item'])) {
                foreach ($event['item'] as $itemParam) {
                    $itemParamPropertyName = (new Stringizer($itemParam['name']))->camelize()->getString();
                    $itemParamValue = get_param_value($itemParam);
                    $itemProps[$itemParamPropertyName] = $itemParamValue;
                }

                continue;
            }

            $paramPropertyName = (new Stringizer($param['name']))->camelize()->getString();
            $paramValue = get_param_value($param);

            $assert['params'][$param['name']] = $paramValue;
            $providerMethod->addBody('$event->parameters->? = ?;', [$paramPropertyName, $paramValue]);
        }

        if (count($itemProps) > 0) {
            $itemClassName = sprintf('%sItem', $eventClassName);
            $namespace->addUse($namespaceName . '\\' . $itemClassName);
            $providerMethod->addBody("\n\$item = new ?();", [new Literal($itemClassName)]);

            foreach ($itemProps as $propName => $propValue) {
                $providerMethod->addBody('$item->? = ?;', [$propName, $propValue]);
                $assert['params']['items'][0][(new CamelToSnake($propName))->execute()] = $propValue;
            }

            $providerMethod->addBody("\n\$event->parameters->addItem(\$item);");
        }
    }

    $arrayTestMethod->setBody('self::assertEquals(?, $event->toArray());', [new Literal($dumper->dump($assert, 10))]);
    $providerMethod->addBody("\nreturn [[\$event]];");

    write_file($dir, $testClassName, $file);
}

function get_param_value(array $param)
{
    $type = get_type($param);

    if ($type === 'int' || $type === 'float') {
        return $type === 'float' ? (float) $param['example'] : (int) $param['example'];
    }

    return $param['example'];
}

function get_type(array $param): ?string
{
    if (false !== strpos($param['type'], 'string')) {
        return 'string';
    }

    if (false !== strpos($param['type'], 'number')) {
        if (false !== strpos($param['example'], '.')) {
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
