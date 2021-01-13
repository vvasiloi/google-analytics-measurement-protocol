<?php

declare(strict_types=1);

namespace Setono\GoogleAnalyticsMeasurementProtocol\Event;

use Setono\GoogleAnalyticsMeasurementProtocol\Event;

/**
 * @property LoginParameters $parameters
 */
final class Login extends Event
{
    /**
     * @var string
     * Send this event to signify that a user has logged in.
     */
    protected $name = 'login';

    public function __construct()
    {
        $this->parameters = new LoginParameters();
    }
}
