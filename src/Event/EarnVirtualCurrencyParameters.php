<?php

declare(strict_types=1);

namespace Setono\GoogleAnalyticsMeasurementProtocol\Event;

use Setono\GoogleAnalyticsMeasurementProtocol\Parameters;

final class EarnVirtualCurrencyParameters extends Parameters
{
    /**
     * @var string
     * The name of the virtual currency.
     * Required: No
     * Example: Gems
     */
    public $virtualCurrencyName;

    /**
     * @var int
     * The value of the virtual currency.
     * Required: No
     * Example: 5
     */
    public $value;
}
