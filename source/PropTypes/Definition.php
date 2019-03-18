<?php

namespace Pre\PropTypes;

class Definition
{
    public $attributes = [];

    public function __call(string $method, array $parameters = [])
    {
        if (count($parameters) < 1) {
            $this->attributes[$method] = true;
        }

        return $this;
    }

    public function __get(string $key)
    {
        if (array_key_exists($key, $this->attributes)) {
            return $this->attributes[$key];
        }
    }

    public function __set(string $key, $value)
    {
        $this->attributes[$key] = $value;
    }
}
