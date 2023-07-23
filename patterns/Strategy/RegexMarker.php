<?php

namespace patterns\Strategy;

class RegexMarker extends Marker
{
    public function mark($response): mixed
    {
        return preg_match($this->test, $response);
    }
}
