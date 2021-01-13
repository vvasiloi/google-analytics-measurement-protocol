<?php

declare(strict_types=1);

namespace Setono\GoogleAnalyticsMeasurementProtocol\Event;

use Setono\GoogleAnalyticsMeasurementProtocol\ItemTrait;
use Setono\GoogleAnalyticsMeasurementProtocol\Parameters;

final class BeginCheckoutItem extends Parameters
{
    use ItemTrait;
}
