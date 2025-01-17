<?php

declare(strict_types=1);

namespace Setono\GoogleAnalyticsMeasurementProtocol\Builder;

use Closure;
use RuntimeException;
use function Safe\sprintf;

abstract class Builder implements BuilderInterface
{
    public function getQuery(): string
    {
        $q = $this->buildQuery($this->getPropertyMapping(), function (?string $parameter, string $value): string {
            if (null === $parameter) {
                return $value . '&';
            }

            return sprintf('%s=%s&', $parameter, $value);
        });

        return rtrim($q, '&');
    }

    public function __toString(): string
    {
        return $this->getQuery();
    }

    /**
     * @param array<string|int, string> $mapping
     */
    protected function buildQuery(array $mapping, Closure $callback): string
    {
        $q = '';

        foreach ($mapping as $parameter => $property) {
            if (!isset($this->{$property})) {
                continue;
            }

            /** @var mixed $val */
            $val = $this->{$property};

            if (!is_scalar($val) && !is_object($val)) {
                throw new RuntimeException(sprintf(
                    'The property %s can only be a scalar or an object', $property
                ));
            }

            // if you cast false to string it returns '' (empty string) and not '0'
            if (is_bool($val) && false === $val) {
                $val = '0';
            }

            if (is_object($val) && !method_exists($val, '__toString')) {
                throw new RuntimeException(sprintf(
                    'The class %s must implement the __toString method', get_class($val)
                ));
            }

            /**
             * if the parameter is an integer we assume that the user doesn't want to output the parameter
             * and hence we supply a null value for the parameter instead
             *
             * @var mixed $res
             * @psalm-suppress PossiblyInvalidCast See https://github.com/vimeo/psalm/issues/4569
             */
            $res = $callback(is_string($parameter) ? $parameter : null, (string) $val);

            if (!is_string($res)) {
                throw new RuntimeException('The callback must always return a string');
            }

            $q .= $res;
        }

        return $q;
    }

    /**
     * @return array<int|string, string>
     */
    abstract protected function getPropertyMapping(): array;
}
