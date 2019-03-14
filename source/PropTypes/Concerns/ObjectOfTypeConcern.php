<?php

namespace Pre\PropTypes\Concerns;

use InvalidArgumentException;

trait ObjectOfTypeConcern
{
    private static function isValidObjectOfType($value, $definition): bool
    {
        $type = $definition->definition;
        $isObject = is_object($value);

        if (!$isObject || !is_a($value, $type)) {
            $actual = $isObject ? get_class($value) : gettype($value);
            throw new InvalidArgumentException("{$actual} is not objectOfType({$type})");
        }

        return true;
    }
}
