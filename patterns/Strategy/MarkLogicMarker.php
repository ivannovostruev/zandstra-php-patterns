<?php

namespace patterns\Strategy;

class MarkLogicMarker extends Marker
{
    private $engine;

    public function __construct($test)
    {
        parent::__construct($test);
        // $this->engine = new MarkParse($test);
    }

    public function mark($response)
    {
        // return $this->engine->evaluate($response);
        return true;
    }
}
