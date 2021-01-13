<?php

declare(strict_types=1);

namespace Setono\GoogleAnalyticsMeasurementProtocol\Event;

use Setono\GoogleAnalyticsMeasurementProtocol\Event;

/**
 * @property RefundParameters $parameters
 */
final class Refund extends Event
{
    /**
     * @var string
     * This event signifies a refund was issued.
     */
    protected $name = 'refund';

    public function __construct()
    {
        $this->parameters = new RefundParameters();
    }
}
