<?php

declare(strict_types=1);

namespace Setono\GoogleAnalyticsMeasurementProtocol\Event;

use Setono\GoogleAnalyticsMeasurementProtocol\Event;

/**
 * @property ViewPromotionParameters $parameters
 */
final class ViewPromotion extends Event
{
    /**
     * @var string
     * This event signifies an promotion was viewed from a list.
     */
    protected $name = 'view_promotion';

    public function __construct()
    {
        $this->parameters = new ViewPromotionParameters();
    }
}
