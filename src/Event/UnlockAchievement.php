<?php

declare(strict_types=1);

namespace Setono\GoogleAnalyticsMeasurementProtocol\Event;

use Setono\GoogleAnalyticsMeasurementProtocol\Event;

/**
 * @property UnlockAchievementParameters $parameters
 */
final class UnlockAchievement extends Event
{
    /**
     * @var string
     * Log this event when the user has unlocked an achievement. This event can help you understand how users are experiencing your game.
     */
    protected $name = 'unlock_achievement';

    public function __construct()
    {
        $this->parameters = new UnlockAchievementParameters();
    }
}
