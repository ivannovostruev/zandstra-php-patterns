<?php

namespace patterns\Strategy;

class MatchMarker extends Marker
{
    public function mark($response): bool
    {
        return $this->test === $response;
    }
}
