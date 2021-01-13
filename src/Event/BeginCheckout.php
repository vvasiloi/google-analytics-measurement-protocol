<?php

declare(strict_types=1);

namespace Setono\GoogleAnalyticsMeasurementProtocol\Event;

use Setono\GoogleAnalyticsMeasurementProtocol\Event;

/**
 * @property BeginCheckoutParameters $parameters
 */
final class BeginCheckout extends Event
{
    /**
     * @var string
     * This event signifies that a user has begun a checkout.
     */
    protected $name = 'begin_checkout';

    public function __construct()
    {
        $this->parameters = new BeginCheckoutParameters();
    }
}
