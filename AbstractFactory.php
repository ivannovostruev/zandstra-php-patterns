<?php
// AbstractFactory

use patterns\AbstractFactory\BloggsCommsManager;
use patterns\AbstractFactory\MegaCommsManager;

require_once 'autoload.php';

$mgr = new MegaCommsManager();
echo $mgr->getHeaderText();
echo $mgr->getApptEncoder()->encode();
echo $mgr->getTtdEncoder()->encode();
echo $mgr->getContactEncoder()->encode();
echo $mgr->getFooterText();
