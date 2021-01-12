<?php

declare(strict_types=1);

namespace Setono\GoogleAnalyticsMeasurementProtocol\Event;

/**
 * @property SignUpEventParameters $parameters
 */
final class SignUpEvent extends Event
{
    /**
     * @var string
     * This event indicates that a user has signed up for an account. Use this event to understand the different behaviors of logged in and logged out users.
     */
    protected $name = 'sign_up';

    public function __construct()
    {
        $this->parameters = new SignUpEventParameters();
    }
}
