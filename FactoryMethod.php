<?php
// FactoryMethod

use patterns\FactoryMethod\BloggsCommunicationsManager;

require_once 'autoload.php';

$manager = new BloggsCommunicationsManager();

echo $manager->getHeaderText();
echo $manager->getAppointmentEncoder()->encode();
echo $manager->getFooterText();
