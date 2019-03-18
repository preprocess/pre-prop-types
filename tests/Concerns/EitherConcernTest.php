<?php

use PHPUnit\Framework\TestCase;
use Pre\PropTypes;

final class EitherConcernTest extends TestCase
{
    public function test_it_allows_null_values()
    {
        $definitions = [
            "value" => PropTypes::either(
                PropTypes::string(),
                PropTypes::int(),
            ),
        ];

        $properties = [
            "other" => true,
        ];

        PropTypes::validate($definitions, $properties);

        $this->addToAssertionCount(1);
    }

    public function test_it_ignores_is_required_on_sub_types()
    {
        $definitions = [
            "value" => PropTypes::either(
                PropTypes::string()->isRequired(),
                PropTypes::int()->isRequired(),
            ),
        ];

        $properties = [
            "other" => true,
        ];

        PropTypes::validate($definitions, $properties);

        $this->addToAssertionCount(1);
    }

    public function test_obeys_is_required()
    {
        $this->expectException(InvalidArgumentException::class, "'value' is required but missing");

        $definitions = [
            "value" => PropTypes::either(PropTypes::string(), PropTypes::int())
                ->isRequired(),
        ];

        $properties = [
            "other" => true,
        ];

        PropTypes::validate($definitions, $properties);
    }

    public function test_it_rejects_either_type()
    {
        $this->expectException(InvalidArgumentException::class, "'value' was neither of the types defined");

        $definitions = [
            "value" => PropTypes::either(PropTypes::string(), PropTypes::int())
                ->isRequired(),
        ];

        $properties = [
            "value" => true,
        ];

        PropTypes::validate($definitions, $properties);
    }

    public function test_it_allowes_either_type()
    {
        $definitions = [
            "value" => PropTypes::either(PropTypes::string(), PropTypes::int())
                ->isRequired(),
        ];

        $properties = [
            "value" => 123,
        ];

        PropTypes::validate($definitions, $properties);

        $this->addToAssertionCount(1);
    }
}
