<?php

namespace patterns\Composite;

class Army extends CompositeUnit
{
    /**
     * @return int
     */
    public function bombardStrength(): int
    {
        $total = 0;
        foreach ($this->units() as $unit) {
            $total += $unit->bombardStrength();
        }
        return $total;
    }
}
