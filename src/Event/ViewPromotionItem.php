<?php

declare(strict_types=1);

namespace Setono\GoogleAnalyticsMeasurementProtocol\Event;

use Setono\GoogleAnalyticsMeasurementProtocol\ItemTrait;
use Setono\GoogleAnalyticsMeasurementProtocol\Parameters;

final class ViewPromotionItem extends Parameters
{
    use ItemTrait;

    /**
     * @var string
     * The ID of a product promotion. One of promotion_id or promotion name is required.
     * Required: Yes*
     * Example: P_12345
     */
    public $promotionId;

    /**
     * @var string
     * The name of a product promotion. One of promotion_id or promotion name is required.
     * Required: Yes*
     * Example: Summer Sale
     */
    public $promotionName;

    /**
     * @var string
     * The name of a creative slot.
     * Required: No
     * Example: featured_app_1
     */
    public $creativeSlot;

    /**
     * @var string
     * The location associated with the event. If possible, set to the Google Place ID that corresponds to the associated item. Can also be overridden to a custom location ID string.
     * Required: No
     * Example: L_12345
     */
    public $locationId;
}
