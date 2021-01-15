<?php

declare(strict_types=1);

namespace Setono\GoogleAnalyticsMeasurementProtocol;

interface AggregateInterface
{
    public function getClientId(): string;

    public function getUserId(): ?string;
    
    public function getEvents(): array;

    public function toArray(): array;
}
