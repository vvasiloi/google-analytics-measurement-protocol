<?php

declare(strict_types=1);

namespace Setono\GoogleAnalyticsMeasurementProtocol\Event;

/**
 * @property PurchaseEventParameters $parameters
 */
final class PurchaseEvent extends Event
{
    /**
     * @var string
     * This event signifies when one or more items is purchased by a user.
     */
    protected $name = 'purchase';

    public function __construct()
    {
        $this->parameters = new PurchaseEventParameters();
    }
}
