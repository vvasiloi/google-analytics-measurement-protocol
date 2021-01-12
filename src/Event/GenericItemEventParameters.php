<?php

declare(strict_types=1);

namespace Setono\GoogleAnalyticsMeasurementProtocol\Event;

class GenericItemEventParameters extends EventParameters
{
    /** @var string */
    public $itemId;

    /** @var string */
    public $itemName;

    /** @var string */
    public $affiliation;

    /** @var string */
    public $coupon;

    /** @var float */
    public $discount;

    /** @var string */
    public $itemBrand;

    /** @var string */
    public $itemCategory;

    /** @var string */
    public $itemVariant;

    /** @var float */
    public $tax;

    /** @var float */
    public $price;

    /** @var string */
    public $currency;
}
