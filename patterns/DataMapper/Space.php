<?php

namespace patterns\DataMapper;

class Space extends DomainObject
{
    private Venue $venue;

    public function setVenue(Venue $venue): void
    {
        $this->venue = $venue;
    }
}
