<?php

namespace Pre;

use Pre\PropTypes\Concerns\ArrayConcern;
use Pre\PropTypes\Concerns\ArrayOfConcern;
use Pre\PropTypes\Concerns\BoolConcern;
use Pre\PropTypes\Concerns\IntConcern;
use Pre\PropTypes\Concerns\ObjectOfTypeConcern;
use Pre\PropTypes\Concerns\StringConcern;
use Pre\PropTypes\Concerns\TypesConcern;
use Pre\PropTypes\Concerns\ValidationConcern;

final class PropTypes
{
    use ArrayConcern;
    use ArrayOfConcern;
    use BoolConcern;
    use IntConcern;
    use ObjectOfTypeConcern;
    use StringConcern;
    use TypesConcern;
    use ValidationConcern;

    private function __construct()
    {
        // hidden to prevent the class being instantiated
    }

    private function __clone()
    {
        // hidden to prevent the class being instantiated
    }
}
