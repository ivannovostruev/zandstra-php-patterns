<?php

namespace patterns\Decorator2;

abstract class ProcessRequestDecorator extends ProcessRequest
{
    public function __construct(
        protected ProcessRequest $processRequest
    ){}
}
