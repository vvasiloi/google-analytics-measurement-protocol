<?php

declare(strict_types=1);

namespace Setono\GoogleAnalyticsMeasurementProtocol\Event;

final class SelectPromotionEventParameters extends EventParameters implements ItemsAwareEventParametersInterface
{
    use ItemsAwareEventParametersTrait;

    /**
     * @var string
     * The ID of the location.
     * Required: No
     * Example: L_12345
     */
    public $locationId;
}
