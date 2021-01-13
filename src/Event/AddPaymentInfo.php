<?php

declare(strict_types=1);

namespace Setono\GoogleAnalyticsMeasurementProtocol\Event;

use Setono\GoogleAnalyticsMeasurementProtocol\Event;

/**
 * @property AddPaymentInfoParameters $parameters
 */
final class AddPaymentInfo extends Event
{
    /**
     * @var string
     * This event signifies a user has submitted their payment information.
     */
    protected $name = 'add_payment_info';

    public function __construct()
    {
        $this->parameters = new AddPaymentInfoParameters();
    }
}
