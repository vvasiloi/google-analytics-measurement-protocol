<?php

declare(strict_types=1);

namespace Setono\GoogleAnalyticsMeasurementProtocol\Event;

use Setono\GoogleAnalyticsMeasurementProtocol\ItemsAwareInterface;
use Setono\GoogleAnalyticsMeasurementProtocol\ItemsAwareTrait;
use Setono\GoogleAnalyticsMeasurementProtocol\Parameters;

final class AddPaymentInfoParameters extends Parameters implements ItemsAwareInterface
{
    use ItemsAwareTrait;

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
     * The chosen method of payment.
     * Required: No
     * Example: Credit Card
     */
    public $paymentType;

    /**
     * @var float
     * The monetary value of the event.
     * Required: No
     * Example: 7.77
     */
    public $value;
}
