<?php
// Command

use patterns\Command\Controller;

require_once 'autoload.php';


$controller = new Controller();

// Эмуляция запроса пользователя
$context = $controller->getContext();
$context->addParam('action', 'login');
$context->addParam('username', 'bob');
$context->addParam('password', 'tiddles');

$controller->process();
