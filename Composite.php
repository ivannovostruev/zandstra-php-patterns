<?php
// Composite

use patterns\Composite\Archer;
use patterns\Composite\Army;
use patterns\Composite\LaserCannonUnit;

require_once 'autoload.php';

$mainArmy = new Army();
$mainArmy->addUnit(new Archer());
$mainArmy->addUnit(new LaserCannonUnit());

$subArmy = new Army();
$subArmy->addUnit(new Archer());
$subArmy->addUnit(new Archer());
$subArmy->addUnit(new Archer());

$mainArmy->addUnit($subArmy);

echo 'Атакующая сила: ' . $mainArmy->bombardStrength();
