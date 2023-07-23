<?php
// Decorator

use patterns\Decorator2\AuthenticateRequest;
use patterns\Decorator2\LogRequest;
use patterns\Decorator2\MainProcess;
use patterns\Decorator2\RequestHelper;
use patterns\Decorator2\StructureRequest;

require_once 'autoload.php';

$process = new AuthenticateRequest(
    new StructureRequest(
        new LogRequest(
            new MainProcess()
        )
    )
);

$process->process(new RequestHelper());
