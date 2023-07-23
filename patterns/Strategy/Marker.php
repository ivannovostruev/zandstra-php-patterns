<?php

namespace patterns\Strategy;

abstract class Marker
{
    protected $test;

    public function __construct($test)
    {
        $this->test = $test;
    }

    abstract public function mark($response);
}
