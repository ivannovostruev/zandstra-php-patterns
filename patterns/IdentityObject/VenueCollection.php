<?php

namespace patterns\IdentityObject;

class VenueCollection extends Collection
{
    /**
     * @return string
     */
    public function getTargetClass(): string
    {
        return __NAMESPACE__ . '\\Venue';
    }
}
