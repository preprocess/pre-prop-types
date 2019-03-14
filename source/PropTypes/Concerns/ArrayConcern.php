<?php

namespace Pre\PropTypes\Concerns;

trait ArrayConcern
{
    private static function isValidArray($value): bool
    {
        return is_array($value);
    }
}
