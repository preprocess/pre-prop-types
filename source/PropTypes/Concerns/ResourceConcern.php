<?php

namespace Pre\PropTypes\Concerns;

trait ResourceConcern
{
    private static function isValidResource($value): bool
    {
        return is_resource($value);
    }
}
