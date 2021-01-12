<?php

declare(strict_types=1);

namespace Setono\GoogleAnalyticsMeasurementProtocol\Event;

/**
 * @property RemoveFromCartEventParameters $parameters
 */
final class RemoveFromCartEvent extends Event
{
    /**
     * @var string
     * This event signifies that an item was removed from a cart.
     */
    protected $name = 'remove_from_cart';

    public function __construct()
    {
        $this->parameters = new RemoveFromCartEventParameters();
    }
}
