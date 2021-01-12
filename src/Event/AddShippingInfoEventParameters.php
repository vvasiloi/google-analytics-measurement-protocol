<?php

declare(strict_types=1);

namespace Setono\GoogleAnalyticsMeasurementProtocol\Event;

final class AddShippingInfoEventParameters extends EventParameters implements ItemsAwareEventParametersInterface
{
    use ItemsAwareEventParametersTrait;

    /**
     * @var string
     * Coupon code used for a purchase.
     * Required: No
     * Example: SUMMER_FUN
     */
    public $coupon;

    /**
     * @var string
     * Currency of the purchase or items associated with the event, in 3-letter ISO 4217 format.
     * Required: No
     * Example: USD
     */
    public $currency;

    /**
     * @var string
     * The shipping tier (e.g. Ground, Air, Next-day) selected for delivery of the purchased item.
     * Required: No
     * Example: Ground
     */
    public $shippingTier;

    /**
     * @var float
     * The monetary value of the event.
     * Required: No
     * Example: 7.77
     */
    public $value;
}
