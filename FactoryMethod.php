<?php
// FactoryMethod

use patterns\FactoryMethod\BloggsCommsManager;

require_once 'autoload.php';

$mgr = new BloggsCommsManager();
echo $mgr->getHeaderText();
echo $mgr->getApptEncoder()->encode();
echo $mgr->getFooterText();
