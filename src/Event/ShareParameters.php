<?php

declare(strict_types=1);

namespace Setono\GoogleAnalyticsMeasurementProtocol\Event;

use Setono\GoogleAnalyticsMeasurementProtocol\Parameters;

final class ShareParameters extends Parameters
{
    /**
     * @var string
     * The method in which the content is shared.
     * Required: No
     * Example: Twitter
     */
    public $method;

    /**
     * @var string
     * The type of shared content.
     * Required: No
     * Example: image
     */
    public $contentType;

    /**
     * @var string
     * The ID of the shared content.
     * Required: No
     * Example: C_12345
     */
    public $contentId;
}