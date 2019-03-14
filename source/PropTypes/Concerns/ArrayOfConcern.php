<?php

namespace Pre\PropTypes\Concerns;

use InvalidArgumentException;
use Pre\PropTypes\Fluent;

trait ArrayOfConcern
{
    private static function isValidArrayOf($value, $definition): bool
    {
        if (!is_array($value)) {
            $actual = is_object($value) ? get_class($value) : gettype($value);
            throw new InvalidArgumentException("{$definition->name} expects {$definition->type}[] but {$actual} provided");
        }

        $definition = $definition->definition;

        if (!is_object($definition) || !is_a($definition, Fluent::class)) {
            throw new InvalidArgumentException("arrayOf missing type definition");
        }

        foreach ($value as $next) {
            $type = strtolower($definition->type);

            $suffix = ucfirst($type);
            $function = "isValid{$suffix}";

            if (!static::{$function}($next)) {
                $actual = gettype($next);

                throw new InvalidArgumentException("{$definition->name} has an unexpected {$actual} in arrayOf({$type})");
            }
        }

        return true;
    }
}
