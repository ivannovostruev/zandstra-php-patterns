<?php

namespace patterns\Visitor;

/**
 * Посетитель сбора налога
 */
class TaxCollectionVisitor extends ArmyVisitor
{
    private int $tax = 0;
    private string $report = '';

    public function visit(Unit $node): void
    {
        $this->levy($node, 1);
    }

    public function visitArcher(Archer $node): void
    {
        $this->levy($node, 2);
    }

    public function visitCavalry(Cavalry $node): void
    {
        $this->levy($node, 3);
    }

    public function visitTrooperCarrierUnit(TroopCarrierUnit $node): void
    {
        $this->levy($node, 5);
    }

    private function levy(Unit $unit, int $amount): void
    {
        $this->report .= 'Налог для ' . $unit::class;
        $this->report .= ': ' . $amount . '<br>' . PHP_EOL;
        $this->tax += $amount;
    }

    public function getReport(): string
    {
        return $this->report;
    }

    public function getTax(): int
    {
        return $this->tax;
    }
}
