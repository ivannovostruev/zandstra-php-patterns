<?php

namespace patterns\Visitor;

class TextDumpArmyVisitor extends ArmyVisitor
{
    private string $text = '';

    public function visit(Unit $node): void
    {
        $text = '';
        $pad = 4 * $node->getDepth();
        $text .= sprintf("%{$pad}s", '');
        $text .= $node::class . ': ';
        $text .= 'Огневая мощь: ' . $node->bombardStrength() . '<br>' . PHP_EOL;
        $this->text .= $text;
    }

    public function getText(): string
    {
        return $this->text;
    }
}
