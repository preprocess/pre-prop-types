<?php

namespace Pre\PropTypes\Concerns;

use InvalidArgumentException;
use Pre\PropTypes\Definition;

trait ArrayOfConcern
{
    private static function isValidArrayOf($value, $definition): bool
    {
        if (!is_array($value)) {
            $actual = is_object($value) ? get_class($value) : gettype($value);
            throw new InvalidArgumentException("{$definition->name} expects {$definition->type}[] but {$actual} provided");
        }

        if (!is_object($definition->definition) || !is_a($definition->definition, Definition::class)) {
            throw new InvalidArgumentException("arrayOf missing type definition");
        }

        foreach ($value as $next) {
            static::validate([
                $definition->name => $definition->definition,
            ], [
                $definition->name => $next,
            ]);
        }

        return true;
    }
}
