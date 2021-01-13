<?php

declare(strict_types=1);

namespace Setono\GoogleAnalyticsMeasurementProtocol;

trait ItemsAwareTrait
{
    /** @var ParametersInterface[] */
    public $items = [];

    public function addItem(ParametersInterface $item): void
    {
        $this->items[] = $item;
    }
}
