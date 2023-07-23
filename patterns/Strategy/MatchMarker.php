<?php

namespace patterns\Strategy;

class MatchMarker extends Marker
{
    public function mark($response)
    {
        return $this->test === $response;
    }
}
