<?php

declare(strict_types=1);

namespace Setono\GoogleAnalyticsMeasurementProtocol\Event;

/**
 * @property AddToWishlistEventParameters $parameters
 */
final class AddToWishlistEvent extends Event
{
    /**
     * @var string
     * The event signifies that an item was added to a wishlist. Use this event to identify popular gift items in your app.
     */
    protected $name = 'add_to_wishlist';

    public function __construct()
    {
        $this->parameters = new AddToWishlistEventParameters();
    }
}
