<?php

declare(strict_types=1);

namespace Setono\GoogleAnalyticsMeasurementProtocol\Event;

use Setono\GoogleAnalyticsMeasurementProtocol\Event;

/**
 * @property JoinGroupParameters $parameters
 */
final class JoinGroup extends Event
{
    /**
     * @var string
     * Log this event when a user joins a group such as a guild, team, or family. Use this event to analyze how popular certain groups or social features are.
     */
    protected $name = 'join_group';

    public function __construct()
    {
        $this->parameters = new JoinGroupParameters();
    }
}