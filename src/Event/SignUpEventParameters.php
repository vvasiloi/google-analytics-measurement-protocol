<?php

declare(strict_types=1);

namespace Setono\GoogleAnalyticsMeasurementProtocol\Event;

final class SignUpEventParameters extends EventParameters
{
    /**
     * @var string
     * The method used for sign up.
     * Required: No
     * Example: Google
     */
    public $method;
}
