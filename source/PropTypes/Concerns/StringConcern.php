<?php

namespace Pre\PropTypes\Concerns;

trait StringConcern
{
    private static function isValidString($value): bool
    {
        return is_string($value);
    }
}
