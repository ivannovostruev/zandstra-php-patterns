<?php

namespace patterns\Prototype;

class TerrainFactory
{
    public function __construct(
        private readonly Sea $sea,
        private readonly Plains $plains,
        private readonly Forest $forest
    ){}

    public function getSea(): Sea
    {
        return clone $this->sea;
    }

    public function getPlains(): Plains
    {
        return clone $this->plains;
    }

    public function getForest(): Forest
    {
        return clone $this->forest;
    }
}
