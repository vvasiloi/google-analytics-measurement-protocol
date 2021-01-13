<?php

declare(strict_types=1);

namespace Setono\GoogleAnalyticsMeasurementProtocol\Event;

use Setono\GoogleAnalyticsMeasurementProtocol\Event;

/**
 * @property ViewItemParameters $parameters
 */
final class ViewItem extends Event
{
    /**
     * @var string
     * This event signifies that some content was shown to the user. Use this event to discover the most popular items viewed.
     */
    protected $name = 'view_item';

    public function __construct()
    {
        $this->parameters = new ViewItemParameters();
    }
}
