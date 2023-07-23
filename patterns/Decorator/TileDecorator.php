<?php

namespace patterns\Decorator;

abstract class TileDecorator extends Tile
{
    public function __construct(
        protected Tile $tile
    ){}
}
