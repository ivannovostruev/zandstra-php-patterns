<?php
// Prototype

use patterns\Prototype\EarthForest;
use patterns\Prototype\EarthPlains;
use patterns\Prototype\EarthSea;
use patterns\Prototype\TerrainFactory;

require_once 'autoload.php';

$factory = new TerrainFactory(
    new EarthSea(),
    new EarthPlains(),
    new EarthForest()
);

echo '<pre>';
print_r($factory->getSea());
print_r($factory->getPlains());
print_r($factory->getForest());
