<?php

namespace patterns\Composite;

abstract class Unit
{
    abstract public function bombardStrength(): int;

    public function getComposite(): ?self
    {
        return null;
    }
}
