<?php

namespace patterns\UnitOfWork;

class SpaceCollection extends Collection
{
    public function getTargetClass(): string
    {
        return __NAMESPACE__ . '\\Space';
    }
}
