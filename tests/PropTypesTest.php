<?php

use PHPUnit\Framework\TestCase;
use Pre\PropTypes;
use Pre\PropTypes\Definition;

final class PropTypesTest extends TestCase
{
    public function test_it_can_create_fluent_definitions()
    {
        $definition = PropTypes::string()->isRequired();

        $this->assertInstanceOf(Definition::class, $definition);
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
        $this->expectException(InvalidArgumentException::class, "'name' is required but missing");

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
        $this->expectException(InvalidArgumentException::class, "'name' expected string but got integer");

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
            "bool" => PropTypes::bool()->isRequired(),
            "boolean" => PropTypes::boolean()->isRequired(),
            "closure" => PropTypes::closure()->isRequired(),
            "double" => PropTypes::double()->isRequired(),
            "float" => PropTypes::float()->isRequired(),
            "int" => PropTypes::int()->isRequired(),
            "integer" => PropTypes::integer()->isRequired(),
            "iterable" => PropTypes::iterable()->isRequired(),
            "numeric" => PropTypes::numeric()->isRequired(),
            "object" => PropTypes::object()->isRequired(),
            "resource" => PropTypes::resource()->isRequired(),
            "string" => PropTypes::string()->isRequired(),
        ];

        $properties = [
            "array" => [1, 2, 3],
            "bool" => false,
            "boolean" => true,
            "closure" => function() {},
            "double" => 1.1,
            "float" => 1.1,
            "int" => 2,
            "integer" => 3,
            "iterable" => [1, 2, 3],
            "numeric" => 123,
            "object" => json_decode(json_encode(["foo" => "bar"])),
            "resource" => fopen("php://memory", "r"),
            "string" => "cats",
        ];

        PropTypes::validate($definitions, $properties);

        $this->addToAssertionCount(count($definitions));
    }

    public function test_it_can_recognise_unrecognised_types()
    {
        $this->expectException(InvalidArgumentException::class, "'unknown' is not a valid type");

        PropTypes::unknown();
    }
}
