<?php

use PHPUnit\Framework\TestCase;
use Pre\PropTypes;
use Pre\PropTypes\Definition;

final class ObjectOfTypeConcernTest extends TestCase
{
    public function test_it_can_tell_non_objects()
    {
        $this->expectException(InvalidArgumentException::class, "integer is not objectOfType(stdClass)");

        $definitions = [
            "objectOfType" => PropTypes::objectOfType(stdClass::class)->isRequired(),
        ];

        $properties = [
            "objectOfType" => 1,
        ];

        PropTypes::validate($definitions, $properties);
    }

    public function test_it_can_tell_objects_with_wrong_type()
    {
        $this->expectException(InvalidArgumentException::class, "Definition is not objectOfType(stdClass)");

        $definitions = [
            "objectOfType" => PropTypes::objectOfType(stdClass::class)->isRequired(),
        ];

        $properties = [
            "objectOfType" => new Definition(),
        ];

        PropTypes::validate($definitions, $properties);
    }

    public function test_it_can_recognise_missing_object_type()
    {
        $this->expectException(InvalidArgumentException::class, "objectOfType missing type");

        PropTypes::objectOfType()->isRequired();
    }
}
