<?php

declare(strict_types=1);

namespace Setono\GoogleAnalyticsMeasurementProtocol;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Uri;
use GuzzleHttp\Psr7\Utils as Psr7Utils;
use GuzzleHttp\Utils;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestInterface;

abstract class EventTestCase extends TestCase
{
    /** @return EventInterface[] */
    abstract public function exampleEventProvider(): iterable;

    protected function assertValidRequest(EventInterface $event): void
    {
        $client = new Client();
        $request = $this->createRequest($event);

        $response = $client->sendRequest($request);
        $contents = $response->getBody()->getContents();
        $data = Utils::jsonDecode($contents, true);

        self::assertEquals(200, $response->getStatusCode());
        self::assertEquals(['validationMessages' => []], $data, sprintf("Unexpected validation issues:\n %s", $contents));
    }

    protected function createRequest(EventInterface $event): RequestInterface
    {
        $aggregate = new Aggregate('XXXXXXXXXX.YYYYYYYYYY', $event);

        $uri = Uri::withQueryValues(
            new Uri('https://www.google-analytics.com/debug/mp/collect'),
            ['api_secret' => '<secret_value>', 'measurement_id' => 'G-XXXXXXXXXX']
        );

        return (new Request('POST', $uri))->withBody(Psr7Utils::streamFor(Utils::jsonEncode($aggregate->toArray())));
    }
}
