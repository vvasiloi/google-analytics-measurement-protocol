<?php

declare(strict_types=1);

namespace Setono\GoogleAnalyticsMeasurementProtocol\Event;

use Setono\GoogleAnalyticsMeasurementProtocol\Parameters;

final class GenerateLeadParameters extends Parameters
{
    /**
     * @var string
     * The currency of the lead, in 3-letter ISO 4217 format.
     * Required: No
     * Example: USD
     */
    public $currency;

    /**
     * @var float
     * The value of the lead.
     * Required: No
     * Example: 99.99
     */
    public $value;
}
