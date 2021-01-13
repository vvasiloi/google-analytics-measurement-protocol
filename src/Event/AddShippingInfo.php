<?php

declare(strict_types=1);

namespace Setono\GoogleAnalyticsMeasurementProtocol\Event;

use Setono\GoogleAnalyticsMeasurementProtocol\Event;

/**
 * @property AddShippingInfoParameters $parameters
 */
final class AddShippingInfo extends Event
{
    /**
     * @var string
     * This event signifies a user has submitted their shipping information.
     */
    protected $name = 'add_shipping_info';

    public function __construct()
    {
        $this->parameters = new AddShippingInfoParameters();
    }
}
