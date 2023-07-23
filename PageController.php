<?php
// PageController

use patterns\PageController\AddVenueController;

require_once 'autoload.php';

$controller = new AddVenueController();
$controller->process();
