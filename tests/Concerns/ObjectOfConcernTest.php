<?php

use PHPUnit\Framework\TestCase;
use Pre\PropTypes;
use Pre\PropTypes\Definition;

final class ObjectOfConcernTest extends TestCase
{
    public function test_it_can_tell_non_objects()
    {
        $this->expectException(InvalidArgumentException::class, "'objectOf' expected stdClass but got integer");

        $definitions = [
            "objectOf" => PropTypes::objectOf(stdClass::class)->isRequired(),
        ];

        $properties = [
            "objectOf" => 1,
        ];

        PropTypes::validate($definitions, $properties);
    }

    public function test_it_can_tell_objects_with_wrong_type()
    {
        $this->expectException(InvalidArgumentException::class, "'objectOf' expected stdClass but got Definition");

        $definitions = [
            "objectOf" => PropTypes::objectOf(stdClass::class)->isRequired(),
        ];

        $properties = [
            "objectOf" => new Definition(),
        ];

        PropTypes::validate($definitions, $properties);
    }

    public function test_it_can_recognise_missing_object_type()
    {
        $this->expectException(InvalidArgumentException::class, "objectOf missing type");

        PropTypes::objectOf()->isRequired();
    }
}
