<?php

declare(strict_types=1);

namespace Setono\GoogleAnalyticsMeasurementProtocol\Event;

use Setono\GoogleAnalyticsMeasurementProtocol\Event;

/**
 * @property LevelUpParameters $parameters
 */
final class LevelUp extends Event
{
    /**
     * @var string
     * This event signifies that a player has leveled up. Use it to gauge the level distribution of your userbase and identify levels that are difficult to complete.
     */
    protected $name = 'level_up';

    public function __construct()
    {
        $this->parameters = new LevelUpParameters();
    }
}
