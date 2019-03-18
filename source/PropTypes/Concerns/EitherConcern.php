<?php

namespace Pre\PropTypes\Concerns;

use Pre\PropTypes\Definition;

trait EitherConcern
{
    public static function either(...$types): Definition
    {
        $definition = new Definition();
        $definition->either = $types;

        return $definition;
    }
}
