<?php

namespace Pre\PropTypes\Concerns;

use InvalidArgumentException;
use Pre\PropTypes\Definition;

trait TypesConcern
{
    private static $types = ["array", "bool", "boolean", "closure", "double", "float", "int", "integer", "iterable", "numeric", "object", "resource", "string"];

    public static function __callStatic(string $method, $parameters = null)
    {
        if ($method === "arrayOf" || $method === "objectOf") {
            $definition = new Definition();
            $definition->type = $method;

            if (!isset($parameters[0])) {
                throw new InvalidArgumentException("{$method} missing type");
            }

            $definition->definition = $parameters[0];

            return $definition;
        }

        if (in_array($method, static::$types)) {
            $definition = new Definition();
            $definition->type = $method;

            return $definition;
        }

        throw new InvalidArgumentException("'{$method}' is not a valid type");
    }
}
