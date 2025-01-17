<?php

declare(strict_types=1);

namespace Setono\GoogleAnalyticsMeasurementProtocol\Builder;

use Setono\GoogleAnalyticsMeasurementProtocol\Request\RequestInterface;

interface RequestAwareBuilderInterface extends BuilderInterface
{
    /**
     * Will use the request data to populate the builder
     */
    public function populateFromRequest(RequestInterface $request): void;
}
