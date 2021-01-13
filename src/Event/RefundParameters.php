<?php

declare(strict_types=1);

namespace Setono\GoogleAnalyticsMeasurementProtocol\Event;

use Setono\GoogleAnalyticsMeasurementProtocol\ItemsAwareInterface;
use Setono\GoogleAnalyticsMeasurementProtocol\ItemsAwareTrait;
use Setono\GoogleAnalyticsMeasurementProtocol\Parameters;

final class RefundParameters extends Parameters implements ItemsAwareInterface
{
    use ItemsAwareTrait;

    /**
     * @var string
     * A product affiliation to designate a supplying company or brick and mortar store location.
     * Required: No
     * Example: Google Store
     */
    public $affiliation;

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
     * The unique identifier of a transaction.
     * Required: No
     * Example: T_12345
     */
    public $transactionId;

    /**
     * @var float
     * Shipping cost associated with a transaction.
     * Required: No
     * Example: 3.33
     */
    public $shipping;

    /**
     * @var float
     * Tax cost associated with a transaction.
     * Required: No
     * Example: 1.11
     */
    public $tax;

    /**
     * @var float
     * The monetary value of the event, in units of the specified currency parameter.
     * Required: No
     * Example: 12.21
     */
    public $value;
}
