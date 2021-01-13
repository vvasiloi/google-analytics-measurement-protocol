<?php

declare(strict_types=1);

namespace Setono\GoogleAnalyticsMeasurementProtocol\Event;

use Setono\GoogleAnalyticsMeasurementProtocol\Event;

/**
 * @property AddToWishlistParameters $parameters
 */
final class AddToWishlist extends Event
{
    /**
     * @var string
     * The event signifies that an item was added to a wishlist. Use this event to identify popular gift items in your app.
     */
    protected $name = 'add_to_wishlist';

    public function __construct()
    {
        $this->parameters = new AddToWishlistParameters();
    }
}
