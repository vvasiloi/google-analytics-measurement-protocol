<?php

declare(strict_types=1);

namespace Setono\GoogleAnalyticsMeasurementProtocol\Event;

use Setono\GoogleAnalyticsMeasurementProtocol\ItemsAwareInterface;
use Setono\GoogleAnalyticsMeasurementProtocol\ItemsAwareTrait;
use Setono\GoogleAnalyticsMeasurementProtocol\Parameters;

final class ViewItemListParameters extends Parameters implements ItemsAwareInterface
{
    use ItemsAwareTrait;

    /**
     * @var string
     * The name of the list in which the item was presented to the user.
     * Required: No
     * Example: Related products
     */
    public $itemListName;

    /**
     * @var string
     * The ID of the list in which the item was presented to the user.
     * Required: No
     * Example: related_products
     */
    public $itemListId;
}
