<?php

namespace patterns\Visitor;

class TextDumpArmyVisitor extends ArmyVisitor
{
    /**
     * @var string
     */
    private string $text = '';

    /**
     * @inheritDoc
     */
    public function visit(Unit $node): void
    {
        $text = '';
        $pad = 4 * $node->getDepth();
        $text .= sprintf("%{$pad}s", '');
        $text .= $node::class . ': ';
        $text .= 'Огневая мощь: ' . $node->bombardStrength() . '<br>' . PHP_EOL;
        $this->text .= $text;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }
}
