<?php

declare(strict_types=1);

namespace Setono\GoogleAnalyticsMeasurementProtocol\Event;

use Setono\GoogleAnalyticsMeasurementProtocol\Event;

/**
 * @property ViewItemListParameters $parameters
 */
final class ViewItemList extends Event
{
    /**
     * @var string
     * Log this event when the user has been presented with a list of items of a certain category.
     */
    protected $name = 'view_item_list';

    public function __construct()
    {
        $this->parameters = new ViewItemListParameters();
    }
}
