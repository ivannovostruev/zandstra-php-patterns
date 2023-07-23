<?php

namespace patterns\Visitor;

abstract class ArmyVisitor
{
    /**
     * @param Unit $node
     */
    abstract public function visit(Unit $node): void;

    /**
     * @param Archer $node
     */
    public function visitArcher(Archer $node): void
    {
        $this->visit($node);
    }

    /**
     * @param Cavalry $node
     */
    public function visitCavalry(Cavalry $node): void
    {
        $this->visit($node);
    }

    /**
     * @param LaserCannonUnit $node
     */
    public function visitLaserCannonUnit(LaserCannonUnit $node): void
    {
        $this->visit($node);
    }

    /**
     * @param TroopCarrierUnit $node
     */
    public function visitTrooperCarrierUnit(TroopCarrierUnit $node): void
    {
        $this->visit($node);
    }

    /**
     * @param Army $node
     */
    public function visitArmy(Army $node): void
    {
        $this->visit($node);
    }
}
