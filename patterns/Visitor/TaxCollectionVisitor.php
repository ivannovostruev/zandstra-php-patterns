<?php

namespace patterns\Visitor;

/**
 * Посетитель сбора налога
 */
class TaxCollectionVisitor extends ArmyVisitor
{
    /**
     * @var int
     */
    private int $tax = 0;

    /**
     * @var string
     */
    private string $report = '';

    /**
     * @inheritDoc
     */
    public function visit(Unit $node): void
    {
        $this->levy($node, 1);
    }

    /**
     * @param Archer $node
     */
    public function visitArcher(Archer $node): void
    {
        $this->levy($node, 2);
    }

    /**
     * @param Cavalry $node
     */
    public function visitCavalry(Cavalry $node): void
    {
        $this->levy($node, 3);
    }

    /**
     * @param TroopCarrierUnit $node
     */
    public function visitTrooperCarrierUnit(TroopCarrierUnit $node): void
    {
        $this->levy($node, 5);
    }

    /**
     * @param Unit $unit
     * @param int $amount
     */
    private function levy(Unit $unit, int $amount): void
    {
        $this->report .= 'Налог для ' . $unit::class;
        $this->report .= ': ' . $amount . '<br>' . PHP_EOL;
        $this->tax += $amount;
    }

    /**
     * @return string
     */
    public function getReport(): string
    {
        return $this->report;
    }

    /**
     * @return int
     */
    public function getTax(): int
    {
        return $this->tax;
    }
}
