<?php

declare(strict_types=1);

namespace Setono\GoogleAnalyticsMeasurementProtocol\Event;

use Setono\GoogleAnalyticsMeasurementProtocol\ItemTrait;
use Setono\GoogleAnalyticsMeasurementProtocol\Parameters;

final class RefundItem extends Parameters
{
    use ItemTrait;

    /**
     * @var float
     * Tax cost associated with a transaction.
     * Required: No
     * Example: 1.11
     */
    public $tax;
}
