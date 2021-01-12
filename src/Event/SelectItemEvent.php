<?php

declare(strict_types=1);

namespace Setono\GoogleAnalyticsMeasurementProtocol\Event;

/**
 * @property SelectItemEventParameters $parameters
 */
final class SelectItemEvent extends Event
{
    /**
     * @var string
     * This event signifies an item was selected from a list.
     */
    protected $name = 'select_item';

    public function __construct()
    {
        $this->parameters = new SelectItemEventParameters();
    }
}
