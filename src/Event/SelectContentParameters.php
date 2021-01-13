<?php

declare(strict_types=1);

namespace Setono\GoogleAnalyticsMeasurementProtocol\Event;

use Setono\GoogleAnalyticsMeasurementProtocol\Parameters;

final class SelectContentParameters extends Parameters
{
    /**
     * @var string
     * The type of selected content.
     * Required: No
     * Example: product
     */
    public $contentType;

    /**
     * @var string
     * An identifier for the item that was selected.
     * Required: No
     * Example: I_12345
     */
    public $itemId;
}
