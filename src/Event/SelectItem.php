<?php

declare(strict_types=1);

namespace Setono\GoogleAnalyticsMeasurementProtocol\Event;

use Setono\GoogleAnalyticsMeasurementProtocol\Event;

/**
 * @property SelectItemParameters $parameters
 */
final class SelectItem extends Event
{
    /**
     * @var string
     * This event signifies an item was selected from a list.
     */
    protected $name = 'select_item';

    public function __construct()
    {
        $this->parameters = new SelectItemParameters();
    }
}
