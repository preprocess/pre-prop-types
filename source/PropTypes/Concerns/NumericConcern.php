<?php

namespace Pre\PropTypes\Concerns;

trait NumericConcern
{
    private static function isValidNumeric($value): bool
    {
        return is_numeric($value);
    }
}
