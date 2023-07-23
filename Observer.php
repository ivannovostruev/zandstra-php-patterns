<?php
// Observer

use patterns\Observer\Login;
use patterns\Observer\GeneralLogger;
use patterns\Observer\PartnershipTool;
use patterns\Observer\SecurityMonitor;

require_once 'autoload.php';

$login = new Login();
new SecurityMonitor($login);
new GeneralLogger($login);
new PartnershipTool($login);

$login->handleLogin('John', 'pass', '123');
