<?php

namespace Pre\PropTypes\Concerns;

use Exception;
use InvalidArgumentException;
use Pre\PropTypes\Definition;

trait ValidationConcern
{
    public static function validate(array $definitions, array $properties)
    {
        foreach ($definitions as $key => $definition) {
            if (!is_object($definition)) {
                throw new InvalidArgumentException("'{$key}' is not a valid type");
            }

            $definition->name = $key;
            static::validatePresence($definition, $key, $properties);

            if (isset($properties[$key]) && $definition->either) {
                foreach ($definition->either as $next) {
                    try {
                        static::validateValue($next, $key, $properties[$key]);
                        // one of them passed...
                        continue 2;
                    } catch (Exception $e) {
                        // try the next type...
                        continue;
                    }

                    throw new InvalidArgumentException("'{$key}' was neither of the types defined");
                }
            }

            if (isset($properties[$key])) {
                static::validateValue($definition, $key, $properties[$key]);
            }
        }
    }

    private static function validatePresence(Definition $definition, string $key, array $properties)
    {
        if (!isset($properties[$key]) && !$definition->isRequired) {
            return;
        }

        if (!isset($properties[$key]) && $definition->isRequired) {
            throw new InvalidArgumentException("'{$key}' was required but not provided");
        }
    }

    private static function validateValue(Definition $definition, $key, $value)
    {
        $expected = strtolower($definition->type);

        $suffix = ucfirst($expected);
        $function = "isValid{$suffix}";

        if (!static::{$function}($value, $definition)) {
            $actual = gettype($value);
            throw new InvalidArgumentException("'{$key}' expected {$expected} but got {$actual}");
        }
    }
}
