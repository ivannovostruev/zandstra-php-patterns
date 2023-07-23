<?php

namespace patterns\Composite;

abstract class CompositeUnit extends Unit
{
    /**
     * @var Unit[]
     */
    private array $units = [];

    public function getComposite(): ?self
    {
        return $this;
    }

    protected function units(): array
    {
        return $this->units;
    }

    /**
     * @param Unit $unit
     */
    public function addUnit(Unit $unit): void
    {
        if (in_array($unit, $this->units, true)) {
            return;
        }
        $this->units[] = $unit;
    }

    public function removeUnit(Unit $unit): void
    {
        $this->units = array_udiff($this->units, [$unit], function($a, $b) {
            return $a !== $b ? 1 : 0;
        });
    }
}
