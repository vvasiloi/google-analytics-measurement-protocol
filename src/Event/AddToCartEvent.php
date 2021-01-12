<?php

declare(strict_types=1);

namespace Setono\GoogleAnalyticsMeasurementProtocol\Event;

/**
 * @property AddToCartEventParameters $parameters
 */
final class AddToCartEvent extends Event
{
    /**
     * @var string
     * This event signifies that an item was added to a cart for purchase.
     */
    protected $name = 'add_to_cart';

    public function __construct()
    {
        $this->parameters = new AddToCartEventParameters();
    }
}
