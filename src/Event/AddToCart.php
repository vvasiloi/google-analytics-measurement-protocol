<?php

declare(strict_types=1);

namespace Setono\GoogleAnalyticsMeasurementProtocol\Event;

use Setono\GoogleAnalyticsMeasurementProtocol\Event;

/**
 * @property AddToCartParameters $parameters
 */
final class AddToCart extends Event
{
    /**
     * @var string
     * This event signifies that an item was added to a cart for purchase.
     */
    protected $name = 'add_to_cart';

    public function __construct()
    {
        $this->parameters = new AddToCartParameters();
    }
}
