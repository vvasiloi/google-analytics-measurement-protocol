<?php

declare(strict_types=1);

namespace Setono\GoogleAnalyticsMeasurementProtocol;

interface ParametersInterface
{
    public function toArray(): array;
}
