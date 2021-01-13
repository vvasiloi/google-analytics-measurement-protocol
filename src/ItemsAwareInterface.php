<?php

declare(strict_types=1);

namespace Setono\GoogleAnalyticsMeasurementProtocol;

interface ItemsAwareInterface extends ParametersInterface
{
    public function addItem(ParametersInterface $item): void;
}
