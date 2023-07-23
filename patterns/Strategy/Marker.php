<?php

namespace patterns\Strategy;

abstract class Marker
{
    public function __construct(
        protected string $test
    ){}

    abstract public function mark($response): mixed;
}
