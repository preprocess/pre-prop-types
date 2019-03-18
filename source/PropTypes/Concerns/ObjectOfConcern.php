<?php

namespace Pre\PropTypes\Concerns;

use InvalidArgumentException;

trait ObjectOfConcern
{
    private static function isValidObjectOf($value, $definition): bool
    {
        $type = $definition->definition;
        $isObject = is_object($value);

        if (!$isObject || !is_a($value, $type)) {
            $actual = $isObject ? get_class($value) : gettype($value);
            throw new InvalidArgumentException("{$actual} is not objectOf({$type})");
        }

        return true;
    }
}
