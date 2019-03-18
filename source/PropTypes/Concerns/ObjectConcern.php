<?php

namespace Pre\PropTypes\Concerns;

trait ObjectConcern
{
    private static function isValidObject($value, $definition): bool
    {
        return is_object($value);
    }
}
