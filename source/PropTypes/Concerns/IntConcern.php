<?php

namespace Pre\PropTypes\Concerns;

trait IntConcern
{
    private static function isValidInt($value): bool
    {
        return is_int($value);
    }

    private static function isValidInteger($value): bool
    {
        return static::isValidInt($value);
    }
}
