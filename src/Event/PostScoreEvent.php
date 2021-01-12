<?php

declare(strict_types=1);

namespace Setono\GoogleAnalyticsMeasurementProtocol\Event;

/**
 * @property PostScoreEventParameters $parameters
 */
final class PostScoreEvent extends Event
{
    /**
     * @var string
     * Send this event when the user posts a score. Use this event to understand how users are performing in your game and correlate high scores with audiences or behaviors.
     */
    protected $name = 'post_score';

    public function __construct()
    {
        $this->parameters = new PostScoreEventParameters();
    }
}
