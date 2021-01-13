<?php

declare(strict_types=1);

namespace Setono\GoogleAnalyticsMeasurementProtocol\Event;

use Setono\GoogleAnalyticsMeasurementProtocol\Event;

/**
 * @property RemoveFromCartParameters $parameters
 */
final class RemoveFromCart extends Event
{
    /**
     * @var string
     * This event signifies that an item was removed from a cart.
     */
    protected $name = 'remove_from_cart';

    public function __construct()
    {
        $this->parameters = new RemoveFromCartParameters();
    }
}
