<?php

namespace Pre\PropTypes\Concerns;

use Pre\PropTypes\Definition;

trait EitherConcern
{
    private static function either(...$types): array
    {
        $definition = new Definition();
        $definition->either = $types;

        return $definition;
    }
}
