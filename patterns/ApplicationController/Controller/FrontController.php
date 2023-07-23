<?php

namespace patterns\ApplicationController\Controller;

use patterns\ApplicationController\ApplicationHelper;
use patterns\ApplicationController\ApplicationRegistry;

class FrontController
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
        $appController = ApplicationRegistry::getAppController();

        while ($command = $appController->getCommand($request)) {
            $command->execute($request);
        }
        $this->invokeView($appController->getView($request));
    }

    private function invokeView(string $target): void
    {
        include __DIR__ . '/../templates/' . $target . '.php';
        exit();
    }
}
