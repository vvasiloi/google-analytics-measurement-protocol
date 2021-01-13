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
            if (!isset($this->{$propertyName})) {
                continue;
            }

            /** @var mixed $value */
            $value = $this->{$propertyName};
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
