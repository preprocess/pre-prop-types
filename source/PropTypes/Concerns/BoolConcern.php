<?php

namespace Pre\PropTypes\Concerns;

trait BoolConcern
{
    private static function isValidBool($value): bool
    {
        return is_bool($value);
    }

    private static function isValidBoolean($value): bool
    {
        return static::isValidBool($value);
    }
}
