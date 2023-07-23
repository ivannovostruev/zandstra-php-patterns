<?php

namespace patterns\Decorator2;

abstract class ProcessRequest
{
    abstract public function process(RequestHelper $request);
}
