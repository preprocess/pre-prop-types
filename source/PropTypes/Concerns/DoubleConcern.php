<?php

namespace Pre\PropTypes\Concerns;

trait DoubleConcern
{
    private static function isValidDouble($value): bool
    {
        return is_double($value);
    }
}
