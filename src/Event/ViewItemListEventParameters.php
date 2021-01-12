<?php

declare(strict_types=1);

namespace Setono\GoogleAnalyticsMeasurementProtocol\Event;

final class ViewItemListEventParameters extends EventParameters implements ItemsAwareEventParametersInterface
{
    use ItemsAwareEventParametersTrait;

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
