<?php
// Decorator

use patterns\Decorator\DiamondDecorator;
use patterns\Decorator\Plains;
use patterns\Decorator\PollutionDecorator;

require_once 'autoload.php';


$tile1 = new Plains();
echo $tile1->getWealthFactor();
echo '<br>';


$tile2 = new DiamondDecorator(new Plains());
echo $tile2->getWealthFactor();
echo '<br>';


$tile3 = new PollutionDecorator(
    new DiamondDecorator(
        new Plains()
    )
);
echo $tile3->getWealthFactor();
echo '<br>';
