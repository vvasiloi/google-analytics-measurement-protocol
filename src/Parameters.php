<?php

declare(strict_types=1);

namespace Setono\GoogleAnalyticsMeasurementProtocol;

use ReflectionClass;
use ReflectionProperty;
use Stringizer\Transformers\CamelToSnake;

abstract class Parameters implements ParametersInterface
{
    public function toArray(): array
    {
        $arr = [];

        $reflectionClass = new ReflectionClass($this);
        $properties = $reflectionClass->getProperties(ReflectionProperty::IS_PUBLIC);

        foreach ($properties as $property) {
            $propertyName = $property->getName();
            /* TODO: for PHP 7.4 and up
            if (!$property->isInitialized($this)) {
                continue;
            }*/

            /** @psalm-suppress MixedAssignment */
            $value = $property->getValue($this);

            if (is_array($value)) {
                $res = [];

                /** @var ParametersInterface $item */
                foreach ($value as $item) {
                    $res[] = $item->toArray();
                }

                $value = $res;
            }

            /** @psalm-suppress MixedAssignment */
            $arr[(string) (new CamelToSnake($propertyName))->execute()] = $value;
        }

        return $arr;
    }
}
