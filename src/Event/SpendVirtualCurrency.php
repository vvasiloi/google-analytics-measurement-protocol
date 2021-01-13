<?php

declare(strict_types=1);

namespace Setono\GoogleAnalyticsMeasurementProtocol\Event;

use Setono\GoogleAnalyticsMeasurementProtocol\Event;

/**
 * @property SpendVirtualCurrencyParameters $parameters
 */
final class SpendVirtualCurrency extends Event
{
    /**
     * @var string
     * This event measures the sale of virtual goods in your app and helps you identify which virtual goods are the most popular.
     */
    protected $name = 'spend_virtual_currency';

    public function __construct()
    {
        $this->parameters = new SpendVirtualCurrencyParameters();
    }
}
