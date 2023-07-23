<?php

namespace patterns\Visitor;

abstract class CompositeUnit extends Unit
{
    /**
     * @var Unit[]
     */
    protected array $units = [];

    protected function units(): array
    {
        return $this->units;
    }

    public function addUnit(Unit $unit): void
    {
        if (in_array($unit, $this->units, true)) {
            return;
        }
        $unit->setDepth($this->depth + 1);
        $this->units[] = $unit;
    }

    public function removeUnit(Unit $unit): void
    {
        $this->units = array_udiff(
            $this->units,
            [$unit],
            fn($a, $b) => $a !== $b ? 1 : 0
        );
    }

    public function accept(ArmyVisitor $visitor): void
    {
        parent::accept($visitor);

        foreach ($this->units as $thisUnit) {
            $thisUnit->accept($visitor);
        }
    }
}
