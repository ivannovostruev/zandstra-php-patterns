<?php

namespace patterns\Visitor;

abstract class Unit
{
    /**
     * @var int Глубина вложенности элемента в иерархическом дереве
     */
    protected int $depth = 0;

    /**
     * @return int
     */
    abstract public function bombardStrength(): int;

    /**
     * @param ArmyVisitor $visitor
     */
    public function accept(ArmyVisitor $visitor): void
    {
        $method = $this->buildVisitorMethodName();
        $visitor->$method($this);
    }

    /**
     * @return string
     */
    private function buildVisitorMethodName(): string
    {
        $reflection = new \ReflectionClass(static::class);
        return 'visit' . $reflection->getShortName();
    }

    /**
     * @param int $depth
     */
    public function setDepth(int $depth): void
    {
        $this->depth = $depth;
    }

    /**
     * @return int
     */
    public function getDepth(): int
    {
        return $this->depth;
    }
}
