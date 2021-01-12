<?php

declare(strict_types=1);

namespace Setono\GoogleAnalyticsMeasurementProtocol\Event;

final class SearchEventTest extends EventTestCase
{
    /**
     * @test
     * @dataProvider exampleEventProvider
     */
    public function it_returns_array(EventInterface $event): void
    {
        self::assertSame(['name' => 'search', 'params' => ['search_term' => 't-shirts']], $event->toArray());
    }

    /**
     * @test
     * @dataProvider exampleEventProvider
     */
    public function it_yields_a_valid_request(EventInterface $event): void
    {
        $this->assertValidRequest($event);
    }

    public function exampleEventProvider(): iterable
    {
        $event = new SearchEvent();
        $event->parameters->searchTerm = 't-shirts';

        return [[$event]];
    }
}
