<?php

declare(strict_types=1);

namespace Setono\GoogleAnalyticsMeasurementProtocol;

trait ItemTrait
{
    /**
     * @var string
     * Item ID (context-specific). *One of item_id or item_name is required for product or impression data.
     * Required: Yes*
     * Example: SKU_12345
     */
    public $itemId;

    /**
     * @var string
     * Item Name (context-specific). *One of item_id or item_name is required for product or impression data.
     * Required: Yes*
     * Example: jeggings
     */
    public $itemName;

    /**
     * @var int
     * Item quantity.
     * Required: No
     * Example: 1
     */
    public $quantity;

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
     * @var float
     * Monetary value of discount associated with a purchase.
     * Required: No
     * Example: 2.22
     */
    public $discount;

    /**
     * @var string
     * Item brand
     * Required: No
     * Example: Gucci
     */
    public $itemBrand;

    /**
     * @var string
     * Item Category (context-specific). item_category2 through item_category5 can also be used if the item has many categories.
     * Required: No
     * Example: pants
     */
    public $itemCategory;

    /**
     * @var float
     * The monetary price of the item, in units of the specified currency parameter.
     * Required: No
     * Example: 9.99
     */
    public $price;

    /**
     * @var string
     * The currency, in 3-letter ISO 4217 format.
     * Required: No
     * Example: USD
     */
    public $currency;
}
