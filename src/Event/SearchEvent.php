<?php

declare(strict_types=1);

namespace Setono\GoogleAnalyticsMeasurementProtocol\Event;

/**
 * @property SearchEventParameters $parameters
 */
final class SearchEvent extends Event
{
    /**
     * @var string
     * Use this event to contextualize search operations. This event can help you identify the most popular content in your app.
     */
    protected $name = 'search';

    public function __construct()
    {
        $this->parameters = new SearchEventParameters();
    }
}
