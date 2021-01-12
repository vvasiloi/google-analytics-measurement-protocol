<?php

declare(strict_types=1);

namespace Setono\GoogleAnalyticsMeasurementProtocol\Event;

final class LoginEventParameters extends EventParameters
{
    /**
     * @var string
     * The method used to login.
     * Required: No
     * Example: Google
     */
    public $method;
}
