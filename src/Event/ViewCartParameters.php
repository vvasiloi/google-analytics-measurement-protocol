<?php

declare(strict_types=1);

namespace Setono\GoogleAnalyticsMeasurementProtocol\Event;

use Setono\GoogleAnalyticsMeasurementProtocol\ItemsAwareInterface;
use Setono\GoogleAnalyticsMeasurementProtocol\ItemsAwareTrait;
use Setono\GoogleAnalyticsMeasurementProtocol\Parameters;

final class ViewCartParameters extends Parameters implements ItemsAwareInterface
{
    use ItemsAwareTrait;

    /**
     * @var string
     * Currency of the items associated with the event, in 3-letter ISO 4217 format.
     * Required: No
     * Example: USD
     */
    public $currency;

    /**
     * @var float
     * The monetary value of the event.
     * Required: No
     * Example: 7.77
     */
    public $value;
}
