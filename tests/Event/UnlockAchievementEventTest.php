<?php

declare(strict_types=1);

namespace Setono\GoogleAnalyticsMeasurementProtocol\Event;

final class UnlockAchievementEventTest extends EventTestCase
{
    /**
     * @test
     * @dataProvider exampleEventProvider
     */
    public function it_returns_array(EventInterface $event): void
    {
        self::assertSame(['name' => 'unlock_achievement', 'params' => ['achievement_id' => 'A_12345']], $event->toArray());
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
        $event = new UnlockAchievementEvent();
        $event->parameters->achievementId = 'A_12345';

        return [[$event]];
    }
}
