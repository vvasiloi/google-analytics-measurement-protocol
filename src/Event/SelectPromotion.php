<?php

declare(strict_types=1);

namespace Setono\GoogleAnalyticsMeasurementProtocol\Event;

use Setono\GoogleAnalyticsMeasurementProtocol\Event;

/**
 * @property SelectPromotionParameters $parameters
 */
final class SelectPromotion extends Event
{
    /**
     * @var string
     * This event signifies an promotion was selected from a list.
     */
    protected $name = 'select_promotion';

    public function __construct()
    {
        $this->parameters = new SelectPromotionParameters();
    }
}
