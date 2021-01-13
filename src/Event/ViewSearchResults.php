<?php

declare(strict_types=1);

namespace Setono\GoogleAnalyticsMeasurementProtocol\Event;

use Setono\GoogleAnalyticsMeasurementProtocol\Event;

/**
 * @property ViewSearchResultsParameters $parameters
 */
final class ViewSearchResults extends Event
{
    /**
     * @var string
     * Log this event when the users has been presented with the results of a search.
     */
    protected $name = 'view_search_results';

    public function __construct()
    {
        $this->parameters = new ViewSearchResultsParameters();
    }
}
