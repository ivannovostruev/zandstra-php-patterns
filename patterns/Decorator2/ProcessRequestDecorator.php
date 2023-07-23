<?php

namespace patterns\Decorator2;

abstract class ProcessRequestDecorator extends ProcessRequest
{
    protected ProcessRequest $processRequest;

    /**
     * @param ProcessRequest $processRequest
     */
    public function __construct(ProcessRequest $processRequest)
    {
        $this->processRequest = $processRequest;
    }
}
