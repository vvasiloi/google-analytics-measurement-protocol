<?php

declare(strict_types=1);

namespace Setono\GoogleAnalyticsMeasurementProtocol\Event;

use Setono\GoogleAnalyticsMeasurementProtocol\Event;

/**
 * @property SelectContentParameters $parameters
 */
final class SelectContent extends Event
{
    /**
     * @var string
     * This event signifies that a user has selected some content of a certain type. This event can help you identify popular content and categories of content in your app.
     */
    protected $name = 'select_content';

    public function __construct()
    {
        $this->parameters = new SelectContentParameters();
    }
}
