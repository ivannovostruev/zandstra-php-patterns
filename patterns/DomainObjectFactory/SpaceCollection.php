<?php

namespace patterns\DomainObjectFactory;

class SpaceCollection extends Collection
{
    public function getTargetClass(): string
    {
        return __NAMESPACE__ . '\\Space';
    }
}
