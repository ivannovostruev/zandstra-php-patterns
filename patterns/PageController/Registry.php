<?php

namespace patterns\PageController;

abstract class Registry
{
    abstract protected function get(string $key);
    abstract protected function set(string $key, $value);
}
