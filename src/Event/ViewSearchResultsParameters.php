<?php

declare(strict_types=1);

namespace Setono\GoogleAnalyticsMeasurementProtocol\Event;

use Setono\GoogleAnalyticsMeasurementProtocol\ItemsAwareInterface;
use Setono\GoogleAnalyticsMeasurementProtocol\ItemsAwareTrait;
use Setono\GoogleAnalyticsMeasurementProtocol\Parameters;

final class ViewSearchResultsParameters extends Parameters implements ItemsAwareInterface
{
    use ItemsAwareTrait;

    /**
     * @var string
     * The term used for the search.
     * Required: No
     * Example: Clothing
     */
    public $searchTerm;
}
