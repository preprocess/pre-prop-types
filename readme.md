# Prop Types

This is a PHP take on the ReactJS Prop Types checking. I made it because I wanted an easier way to validate the type and presence of properties in Phpx components.

## Getting started

```
git clone git@github.com:preprocess/pre-prop-types.git
cd pre-prop-types
composer install
composer test
```

## Defining types

We support most of the built-in types:

```php
use App\Profile;
use Pre\PropTypes;

$profile = Profile::find(1);

$definitions = [
    "name" => PropTypes::string()->isRequired(),
    "age" => PropTypes::int(),
    "rating" => PropTypes::float(),
    "permissions" => PropTypes::arrayOf(PropTypes::string()),
    "thumbnail" => PropTypes::either(
        PropTypes::string(), // uri
        PropTypes::resource(), // file handle
    ),
    "profile" => PropTypes::objectOf(Profile::class)->isRequired(),
    "notifier" => PropTypes::closure()->isRequired(),
    "isAdmin" => PropTypes::bool()->isRequired(),
];

$properties = [
    "name" => "Joe",
    "profile" => $profile,
    "notifier" => function($message) use ($profile) {
        $profile->notify($message);
    },
    "isAdmin" => false,
];

try {
    PropTypes::validate($definitions, $properties);
} catch (InvalidArgumentException $e) {
    // ...handle the error
}
```

- `isRequired` will ensure the value is present in the accompanying properties array
- `either` allows one or more types (preferably two distinct types) for comparison

There are also variations on these:

- `PropTypes::array()` expects any array values, without a specific type
- `PropTypes::boolean()` is the same as `PropTypes::bool()`
- `PropTypes::integer()` is the same as `PropTypes::int()`
- `PropTypes::double()` expects double values
- `PropTypes::iterable()` expects any iterable values
- `PropTypes::numeric()` expects any numeric values
- `PropTypes::object()` expects any object values, without a specific type

## Validating types

We don't automatically validate props – this must be done by the consumer. And example Phpx render method demonstrates this:

```php
use Pre\PropTypes;
use function Pre\Phpx\Html\render as renderHTML;

function render($type, $props = []) {
    $props = (array) $props;

    if (class_exists($type)) {
        if (method_exists($type, "propTypes")) {
            PropTypes::validate($type::propTypes(), $props);
        }

        if (method_exists($type, "defaultProps")) {
            $props = array_merge($type::defaultProps(), $props);
        }
    }

    return renderHTML($type, $props);
}

render("App\\Custom\\Component");
```
