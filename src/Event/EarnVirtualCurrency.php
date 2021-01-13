<?php

declare(strict_types=1);

namespace Setono\GoogleAnalyticsMeasurementProtocol\Event;

use Setono\GoogleAnalyticsMeasurementProtocol\Event;

/**
 * @property EarnVirtualCurrencyParameters $parameters
 */
final class EarnVirtualCurrency extends Event
{
    /**
     * @var string
     * This event measures the awarding of virtual currency. Log this along with spend_virtual_currency to better understand your virtual economy.
     */
    protected $name = 'earn_virtual_currency';

    public function __construct()
    {
        $this->parameters = new EarnVirtualCurrencyParameters();
    }
}
