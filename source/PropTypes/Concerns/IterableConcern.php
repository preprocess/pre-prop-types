<?php

namespace Pre\PropTypes\Concerns;

trait IterableConcern
{
    private static function isValidIterable($value): bool
    {
        return is_iterable($value);
    }
}
