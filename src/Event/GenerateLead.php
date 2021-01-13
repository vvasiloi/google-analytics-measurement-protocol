<?php

declare(strict_types=1);

namespace Setono\GoogleAnalyticsMeasurementProtocol\Event;

use Setono\GoogleAnalyticsMeasurementProtocol\Event;

/**
 * @property GenerateLeadParameters $parameters
 */
final class GenerateLead extends Event
{
    /**
     * @var string
     * Log this event when a lead has been generated to understand the efficacy of your re-engagement campaigns.
     */
    protected $name = 'generate_lead';

    public function __construct()
    {
        $this->parameters = new GenerateLeadParameters();
    }
}
