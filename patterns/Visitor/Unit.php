<?php

namespace patterns\Visitor;

abstract class Unit
{
    /**
     * Глубина вложенности элемента в иерархическом дереве
     */
    protected int $depth = 0;

    abstract public function bombardStrength(): int;

    public function accept(ArmyVisitor $visitor): void
    {
        $method = $this->buildVisitorMethodName();
        $visitor->$method($this);
    }

    private function buildVisitorMethodName(): string
    {
        $reflection = new \ReflectionClass(static::class);
        return 'visit' . $reflection->getShortName();
    }

    public function setDepth(int $depth): void
    {
        $this->depth = $depth;
    }

    public function getDepth(): int
    {
        return $this->depth;
    }
}
