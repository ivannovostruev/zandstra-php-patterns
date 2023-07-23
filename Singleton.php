<?php
// Singleton

use patterns\Singleton\Preferences;

require_once 'autoload.php';

$pref1 = Preferences::getInstance();
$pref1->setProperty('name', 'John');

unset($pref1);

$pref2 = Preferences::getInstance();
echo $pref2->getProperty('name');
