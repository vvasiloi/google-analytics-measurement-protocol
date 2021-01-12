<?php

declare(strict_types=1);

namespace Setono\GoogleAnalyticsMeasurementProtocol\Event;

final class SearchEventParameters extends EventParameters
{
    /**
     * @var string
     * The term that was searched for.
     * Required: Yes
     * Example: t-shirts
     */
    public $searchTerm;
}
