<?php

declare(strict_types=1);

namespace Setono\GoogleAnalyticsMeasurementProtocol\Event;

/**
 * @property SelectPromotionEventParameters $parameters
 */
final class SelectPromotionEvent extends Event
{
    /**
     * @var string
     * This event signifies an promotion was selected from a list.
     */
    protected $name = 'select_promotion';

    public function __construct()
    {
        $this->parameters = new SelectPromotionEventParameters();
    }
}
