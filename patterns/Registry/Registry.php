<?php

namespace patterns\Registry;

abstract class Registry
{
    abstract protected function get(string $key);
    abstract protected function set(string $key, $value);
}
