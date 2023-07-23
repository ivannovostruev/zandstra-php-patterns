<?php
// AbstractFactory

use patterns\AbstractFactory\BloggsCommunicationsManager;
use patterns\AbstractFactory\MegaCommunicationsManager;

require_once 'autoload.php';

$manager = new MegaCommunicationsManager();

echo $manager->getHeaderText();
echo $manager->getAppointmentEncoder()->encode();
echo $manager->getTaskEncoder()->encode();
echo $manager->getContactEncoder()->encode();
echo $manager->getFooterText();
