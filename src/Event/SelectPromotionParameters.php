<?php

declare(strict_types=1);

namespace Setono\GoogleAnalyticsMeasurementProtocol\Event;

use Setono\GoogleAnalyticsMeasurementProtocol\ItemsAwareInterface;
use Setono\GoogleAnalyticsMeasurementProtocol\ItemsAwareTrait;
use Setono\GoogleAnalyticsMeasurementProtocol\Parameters;

final class SelectPromotionParameters extends Parameters implements ItemsAwareInterface
{
    use ItemsAwareTrait;

    /**
     * @var string
     * The ID of the location.
     * Required: No
     * Example: L_12345
     */
    public $locationId;
}
