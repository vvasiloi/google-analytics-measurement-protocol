<?php

declare(strict_types=1);

namespace Setono\GoogleAnalyticsMeasurementProtocol\Event;

use Setono\GoogleAnalyticsMeasurementProtocol\Parameters;

final class SearchParameters extends Parameters
{
    /**
     * @var string
     * The term that was searched for.
     * Required: Yes
     * Example: t-shirts
     */
    public $searchTerm;
}
