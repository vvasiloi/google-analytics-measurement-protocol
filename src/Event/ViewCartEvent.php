<?php

declare(strict_types=1);

namespace Setono\GoogleAnalyticsMeasurementProtocol\Event;

/**
 * @property ViewCartEventParameters $parameters
 */
final class ViewCartEvent extends Event
{
    /**
     * @var string
     * This event signifies that a user viewed their cart.
     */
    protected $name = 'view_cart';

    public function __construct()
    {
        $this->parameters = new ViewCartEventParameters();
    }
}
