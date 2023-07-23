<?php

namespace patterns\Strategy;

class MarkLogicMarker extends Marker
{
    private $engine;

    public function __construct(string $test)
    {
        parent::__construct($test);
        // $this->engine = new MarkParse($test);
    }

    public function mark($response): bool
    {
        // return $this->engine->evaluate($response);
        return true;
    }
}
