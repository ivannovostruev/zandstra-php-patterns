<?php
// Visitor

use patterns\Visitor\{
    Archer,
    Army,
    Cavalry,
    LaserCannonUnit,
    TaxCollectionVisitor,
    TextDumpArmyVisitor
};

require_once 'autoload.php';


$mainArmy = new Army();
$mainArmy->addUnit(new Archer());
$mainArmy->addUnit(new LaserCannonUnit());
$mainArmy->addUnit(new Cavalry());

$textDump = new TextDumpArmyVisitor();
$mainArmy->accept($textDump);
echo $textDump->getText();

echo '<hr>';

$newArmy = new Army();
$newArmy->addUnit(new Archer());
$newArmy->addUnit(new LaserCannonUnit());
$newArmy->addUnit(new Cavalry());

$taxCollector = new TaxCollectionVisitor();
$newArmy->accept($taxCollector);
echo $taxCollector->getReport();
echo 'ИТОГО: ';
echo $taxCollector->getTax() . PHP_EOL;
