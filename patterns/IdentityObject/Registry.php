<?php

namespace patterns\IdentityObject;

abstract class Registry
{
    abstract protected function get(string $key);
    abstract protected function set(string $key, $value);
}
