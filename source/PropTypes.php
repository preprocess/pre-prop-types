<?php

namespace Pre;

use Pre\PropTypes\Concerns\ArrayConcern;
use Pre\PropTypes\Concerns\ArrayOfConcern;
use Pre\PropTypes\Concerns\BoolConcern;
use Pre\PropTypes\Concerns\ClosureConcern;
use Pre\PropTypes\Concerns\DoubleConcern;
use Pre\PropTypes\Concerns\EitherConcern;
use Pre\PropTypes\Concerns\FloatConcern;
use Pre\PropTypes\Concerns\IntConcern;
use Pre\PropTypes\Concerns\IterableConcern;
use Pre\PropTypes\Concerns\NumericConcern;
use Pre\PropTypes\Concerns\ObjectConcern;
use Pre\PropTypes\Concerns\ObjectOfConcern;
use Pre\PropTypes\Concerns\ResourceConcern;
use Pre\PropTypes\Concerns\StringConcern;
use Pre\PropTypes\Concerns\TypesConcern;
use Pre\PropTypes\Concerns\ValidationConcern;

final class PropTypes
{
    use ArrayConcern;
    use ArrayOfConcern;
    use BoolConcern;
    use ClosureConcern;
    use DoubleConcern;
    use EitherConcern;
    use FloatConcern;
    use IntConcern;
    use IterableConcern;
    use NumericConcern;
    use ObjectConcern;
    use ObjectOfConcern;
    use ResourceConcern;
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
