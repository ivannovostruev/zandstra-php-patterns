<?php

namespace patterns\DataMapper;

class SpaceCollection extends Collection
{
    /**
     * @return string
     */
    public function getTargetClass(): string
    {
        return __NAMESPACE__ . '\\Space';
    }
}
