<?php

declare(strict_types=1);

namespace Setono\GoogleAnalyticsMeasurementProtocol\Event;

final class PostScoreEventTest extends EventTestCase
{
    /**
     * @test
     * @dataProvider exampleEventProvider
     */
    public function it_returns_array(EventInterface $event): void
    {
        self::assertSame(['name' => 'post_score', 'params' => ['score' => 10000, 'level' => 5, 'character' => 'Player 1']], $event->toArray());
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
        $event = new PostScoreEvent();
        $event->parameters->score = 10000;
        $event->parameters->level = 5;
        $event->parameters->character = 'Player 1';

        return [[$event]];
    }
}
