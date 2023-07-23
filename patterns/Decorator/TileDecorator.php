<?php

namespace patterns\Decorator;

abstract class TileDecorator extends Tile
{
    protected Tile $tile;

    /**
     * @param Tile $tile
     */
    public function __construct(Tile $tile)
    {
        $this->tile = $tile;
    }
}
