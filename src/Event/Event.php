<?php

declare(strict_types=1);

namespace Setono\GoogleAnalyticsMeasurementProtocol\Event;

abstract class Event implements EventInterface
{
    /** @var string */
    protected $name;

    /** @var EventParametersInterface|null */
    public $parameters;

    public function toArray(): array
    {
        $arr = ['name' => $this->name];

        if (null !== $this->parameters) {
            $arr['params'] = $this->parameters->toArray();
        }

        return $arr;
    }
}
