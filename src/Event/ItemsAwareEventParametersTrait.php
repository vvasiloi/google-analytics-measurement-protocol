<?php

declare(strict_types=1);

namespace Setono\GoogleAnalyticsMeasurementProtocol\Event;

trait ItemsAwareEventParametersTrait
{
    /** @var GenericItemEventParameters[] */
    public $items = [];

    public function addItem(GenericItemEventParameters $item): void
    {
        $this->items[] = $item;
    }
}
