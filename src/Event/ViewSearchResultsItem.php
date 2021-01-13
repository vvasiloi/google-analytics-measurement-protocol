<?php

declare(strict_types=1);

namespace Setono\GoogleAnalyticsMeasurementProtocol\Event;

use Setono\GoogleAnalyticsMeasurementProtocol\ItemTrait;
use Setono\GoogleAnalyticsMeasurementProtocol\Parameters;

final class ViewSearchResultsItem extends Parameters
{
    use ItemTrait;

    /**
     * @var int
     * The index of the item in a list.
     * Required: No
     * Example: 5
     */
    public $index;

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
