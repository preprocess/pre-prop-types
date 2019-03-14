<?php

namespace Pre\PropTypes\Concerns;

use InvalidArgumentException;

trait ValidationConcern
{
    public static function validate(array $definitions, array $properties)
    {
        foreach ($definitions as $key => $definition) {
            if (!isset($properties[$key]) && !$definition->isRequired) {
                continue;
            }

            if (!isset($properties[$key]) && $definition->isRequired) {
                throw new InvalidArgumentException("{$key} is required but missing");
            }

            $value = $properties[$key];
            $expected = strtolower($definition->type);

            $suffix = ucfirst($expected);
            $function = "isValid{$suffix}";

            $definition->name = $key;

            if (!static::{$function}($value, $definition)) {
                $actual = gettype($value);
                throw new InvalidArgumentException("{$key} expects {$expected} but {$actual} provided");
            }
        }
    }
}
