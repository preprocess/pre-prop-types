<?php

namespace Pre\PropTypes\Concerns;

trait FloatConcern
{
    private static function isValidFloat($value): bool
    {
        return is_float($value);
    }
}
