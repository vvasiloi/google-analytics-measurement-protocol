<?php

declare(strict_types=1);

namespace Setono\GoogleAnalyticsMeasurementProtocol\Event;

use Setono\GoogleAnalyticsMeasurementProtocol\Event;

/**
 * @property ViewCartParameters $parameters
 */
final class ViewCart extends Event
{
    /**
     * @var string
     * This event signifies that a user viewed their cart.
     */
    protected $name = 'view_cart';

    public function __construct()
    {
        $this->parameters = new ViewCartParameters();
    }
}
