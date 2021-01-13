<?php

declare(strict_types=1);

namespace Setono\GoogleAnalyticsMeasurementProtocol;

abstract class Event implements EventInterface
{
    /** @var string */
    protected $name;

    /** @var ParametersInterface|null */
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
