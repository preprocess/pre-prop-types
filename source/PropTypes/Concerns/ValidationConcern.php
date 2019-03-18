<?php

namespace Pre\PropTypes\Concerns;

use InvalidArgumentException;
use Pre\PropTypes\Definition;

trait ValidationConcern
{
    public static function validate(array $definitions, array $properties)
    {
        foreach ($definitions as $key => $definition) {
            if ($definition->either) {
                static::validateMultipleTypes($definition, $properties);

                foreach ($definition->either as $next) {
                    if (isset($properties[$key])) {
                        static::validateValue($next, $key, $properties[$key]);
                    }
                }
                
                continue;
            }

            static::validateSingleType($definition, $key, $properties);

            if (isset($properties[$key])) {
                static::validateValue($definition, $key, $properties[$key]);
            }
        }
    }

    private static function validateMultipleTypes(Definition $definition, array $properties)
    {
        if ($definition->isRequired) {
            $found = false;

            foreach ($definition->either as $key => $value) {
                if (isset($properties[$key])) {
                    $found = true;
                }
            }

            if (!$found) {
                throw new InvalidArgumentException("{$key} is required but missing");
            }
        }
    }

    private static function validateSingleType(Definition $definition, string $key, array $properties)
    {
        if (!isset($properties[$key]) && !$definition->isRequired) {
            return;
        }

        if (!isset($properties[$key]) && $definition->isRequired) {
            throw new InvalidArgumentException("{$key} is required but missing");
        }
    }

    private static function validateValue(Definition $definition, $key, $value)
    {
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
