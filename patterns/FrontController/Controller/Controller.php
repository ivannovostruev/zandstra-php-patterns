<?php

namespace patterns\FrontController\Controller;

use patterns\FrontController\ApplicationHelper;
use patterns\FrontController\ApplicationRegistry;
use patterns\FrontController\CommandResolver;

class Controller
{
    private ApplicationHelper $applicationHelper;

    private function __construct(){}

    public static function run()
    {
        $instance = new self();
        $instance->init();
        $instance->handleRequest();
    }

    private function init()
    {
        $this->applicationHelper = ApplicationHelper::getInstance();
        $this->applicationHelper->init();
    }

    private function handleRequest()
    {
        $request = ApplicationRegistry::getRequest();
        $commandResolver = new CommandResolver();
        $command = $commandResolver->getCommand($request);
        $command->execute($request);
    }
}
