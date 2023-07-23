<?php

namespace patterns\IdentityObject;

class EventCollection extends Collection
{
    /**
     * @return string
     */
    public function getTargetClass(): string
    {
        return __NAMESPACE__ . '\\Event';
    }
}
