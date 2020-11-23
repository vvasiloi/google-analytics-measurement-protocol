<?php

declare(strict_types=1);

namespace Setono\GoogleAnalyticsMeasurementProtocol\Event;

final class AddShippingInfoEventParameters extends EventParameters implements ItemsAwareEventParametersInterface
{
    use ItemsAwareEventParametersTrait;

    /**
     * Coupon code used for a purchase.
     * Required: No
     * Example: SUMMER_FUN
     */
    public string $coupon;

    /**
     * Currency of the purchase or items associated with the event, in 3-letter ISO 4217 format.
     * Required: No
     * Example: USD
     */
    public string $currency;

    /**
     * The shipping tier (e.g. Ground, Air, Next-day) selected for delivery of the purchased item.
     * Required: No
     * Example: Ground
     */
    public string $shippingTier;

    /**
     * The monetary value of the event.
     * Required: No
     * Example: 7.77
     */
    public float $value;
}