<?php

declare(strict_types=1);

namespace Setono\GoogleAnalyticsMeasurementProtocol;

interface EventInterface
{
    public function toArray(): array;
}
