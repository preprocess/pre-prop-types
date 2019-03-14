<?php

use PHPUnit\Framework\TestCase;
use Pre\PropTypes;
use Pre\PropTypes\Fluent;

final class PropTypesTest extends TestCase
{
    public function test_it_can_create_fluent_definitions()
    {
        $definition = PropTypes::string()->isRequired();

        $this->assertInstanceOf(Fluent::class, $definition);
        $this->assertEquals($definition->type, "string");
        $this->assertTrue($definition->isRequired);
    }

    public function test_it_can_allow_null_for_optional_values()
    {
        $definitions = [
            "name" => PropTypes::string(),
        ];

        $properties = [
            "age" => 99,
        ];

        PropTypes::validate($definitions, $properties);

        $this->addToAssertionCount(1);
    }

    public function test_it_can_require_values()
    {
        $this->expectException(InvalidArgumentException::class, "name is required but missing");

        $definitions = [
            "name" => PropTypes::string()->isRequired(),
        ];

        $properties = [
            "age" => 99,
        ];

        PropTypes::validate($definitions, $properties);
    }

    public function test_it_can_validate_correct_values()
    {
        $definitions = [
            "name" => PropTypes::string()->isRequired(),
        ];

        $properties = [
            "name" => "Joe",
        ];

        PropTypes::validate($definitions, $properties);

        $this->addToAssertionCount(1);
    }

    public function test_it_can_validate_incorrect_values()
    {
        $this->expectException(InvalidArgumentException::class, "name expects string but integer provided");

        $definitions = [
            "name" => PropTypes::string()->isRequired(),
        ];

        $properties = [
            "name" => 99,
        ];

        PropTypes::validate($definitions, $properties);
    }

    public function test_it_can_validate_a_range_of_types()
    {
        $definitions = [
            "array" => PropTypes::array()->isRequired(),
            "arrayOf" => PropTypes::arrayOf(PropTypes::string())->isRequired(),
            "bool" => PropTypes::bool()->isRequired(),
            "boolean" => PropTypes::boolean()->isRequired(),
            "int" => PropTypes::int()->isRequired(),
            "integer" => PropTypes::integer()->isRequired(),
            "objectOfType" => PropTypes::objectOfType(stdClass::class)->isRequired(),
            "string" => PropTypes::string()->isRequired(),
        ];

        $properties = [
            "array" => [1, 2, 3],
            "arrayOf" => ["1", "2", "3"],
            "bool" => false,
            "boolean" => true,
            "int" => 2,
            "integer" => 3,
            "objectOfType" => new stdClass(),
            "string" => "cats",
        ];

        PropTypes::validate($definitions, $properties);

        $this->addToAssertionCount(count($definitions));
    }

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
        $this->expectException(InvalidArgumentException::class, "Fluent is not objectOfType(stdClass)");

        $definitions = [
            "objectOfType" => PropTypes::objectOfType(stdClass::class)->isRequired(),
        ];

        $properties = [
            "objectOfType" => new Fluent(),
        ];

        PropTypes::validate($definitions, $properties);
    }

    public function test_it_can_recognise_missing_object_type()
    {
        $this->expectException(InvalidArgumentException::class, "objectOfType missing type");

        PropTypes::objectOfType()->isRequired();
    }

    public function test_it_can_recognise_unrecognised_types()
    {
        $this->expectException(InvalidArgumentException::class, "unknown is not a valid type");

        PropTypes::unknown();
    }

    public function test_it_can_tell_when_array_of_isnt_array()
    {
        $this->expectException(InvalidArgumentException::class, "arrayOf expects string[] but integer provided");

        $definitions = [
            "arrayOf" => PropTypes::arrayOf(PropTypes::string())->isRequired(),
        ];

        $properties = [
            "arrayOf" => 1,
        ];

        PropTypes::validate($definitions, $properties);
    }

    public function test_it_can_tell_when_array_of_has_a_bad_type_definition()
    {
        $this->expectException(InvalidArgumentException::class, "arrayOf expects string[] but integer provided");

        $definitions = [
            "arrayOf" => PropTypes::arrayOf("foo")->isRequired(),
        ];

        $properties = [
            "arrayOf" => [1, 2, 3],
        ];

        PropTypes::validate($definitions, $properties);
    }

    public function test_it_can_tell_array_of_items_types()
    {
        $this->expectException(InvalidArgumentException::class, "arrayOf has an unexpected integer in arrayOf(string)");

        $definitions = [
            "arrayOf" => PropTypes::arrayOf(PropTypes::int())->isRequired(),
        ];

        $properties = [
            "arrayOf" => [1, "2", 3],
        ];

        PropTypes::validate($definitions, $properties);
    }
}
