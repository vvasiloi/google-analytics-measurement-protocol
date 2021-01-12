<?php

declare(strict_types=1);

namespace Setono\GoogleAnalyticsMeasurementProtocol\Event;

/**
 * @property ShareEventParameters $parameters
 */
final class ShareEvent extends Event
{
    /**
     * @var string
     * Use this event to identify viral content.
     */
    protected $name = 'share';

    public function __construct()
    {
        $this->parameters = new ShareEventParameters();
    }
}
