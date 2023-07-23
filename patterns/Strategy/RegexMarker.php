<?php

namespace patterns\Strategy;

class RegexMarker extends Marker
{
    public function mark($response)
    {
        return preg_match($this->test, $response);
    }
}
