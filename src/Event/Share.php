<?php

declare(strict_types=1);

namespace Setono\GoogleAnalyticsMeasurementProtocol\Event;

use Setono\GoogleAnalyticsMeasurementProtocol\Event;

/**
 * @property ShareParameters $parameters
 */
final class Share extends Event
{
    /**
     * @var string
     * Use this event to identify viral content.
     */
    protected $name = 'share';

    public function __construct()
    {
        $this->parameters = new ShareParameters();
    }
}
