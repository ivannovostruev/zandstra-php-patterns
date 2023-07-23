<?php

namespace patterns\Visitor;

abstract class ArmyVisitor
{
    abstract public function visit(Unit $node): void;

    public function visitArcher(Archer $node): void
    {
        $this->visit($node);
    }

    public function visitCavalry(Cavalry $node): void
    {
        $this->visit($node);
    }

    public function visitLaserCannonUnit(LaserCannonUnit $node): void
    {
        $this->visit($node);
    }

    public function visitTrooperCarrierUnit(TroopCarrierUnit $node): void
    {
        $this->visit($node);
    }

    public function visitArmy(Army $node): void
    {
        $this->visit($node);
    }
}
