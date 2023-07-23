<?php

namespace patterns\Composite;

class Army extends CompositeUnit
{
    public function bombardStrength(): int
    {
        $total = 0;
        foreach ($this->units() as $unit) {
            $total += $unit->bombardStrength();
        }
        return $total;
    }
}
