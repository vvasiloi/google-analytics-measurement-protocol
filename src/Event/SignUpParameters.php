<?php

declare(strict_types=1);

namespace Setono\GoogleAnalyticsMeasurementProtocol\Event;

use Setono\GoogleAnalyticsMeasurementProtocol\Parameters;

final class SignUpParameters extends Parameters
{
    /**
     * @var string
     * The method used for sign up.
     * Required: No
     * Example: Google
     */
    public $method;
}
