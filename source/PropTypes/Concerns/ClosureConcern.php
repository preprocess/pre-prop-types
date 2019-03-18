<?php

namespace Pre\PropTypes\Concerns;

use Closure;

trait ClosureConcern
{
    private static function isValidClosure($value): bool
    {
        return is_object($value) && $value instanceof Closure;
    }
}
