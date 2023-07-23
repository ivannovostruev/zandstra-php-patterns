<?php

namespace patterns\FrontController\Command;

use patterns\FrontController\Request\Request;

abstract class Command
{
    final public function __construct(){}

    public function execute(Request $request): bool
    {
        return $this->doExecute($request);
    }

    abstract public function doExecute(Request $request): bool;
}
