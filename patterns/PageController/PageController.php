<?php

namespace patterns\PageController;

abstract class PageController
{
    abstract public function process();

    public function forward(string $resource): void
    {
        include $resource;
        exit();
    }

    public function getRequest(): Request
    {
        return ApplicationRegistry::getRequest();
    }
}
