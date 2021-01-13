<?php

declare(strict_types=1);

namespace Setono\GoogleAnalyticsMeasurementProtocol\Event;

use Setono\GoogleAnalyticsMeasurementProtocol\Parameters;

final class LoginParameters extends Parameters
{
    /**
     * @var string
     * The method used to login.
     * Required: No
     * Example: Google
     */
    public $method;
}
