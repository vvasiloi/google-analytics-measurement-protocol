<?php

declare(strict_types=1);

namespace Setono\GoogleAnalyticsMeasurementProtocol\Event;

final class ViewSearchResultsEventParameters extends EventParameters implements ItemsAwareEventParametersInterface
{
    use ItemsAwareEventParametersTrait;

    /**
     * @var string
     * The term used for the search.
     * Required: No
     * Example: Clothing
     */
    public $searchTerm;
}
