<?php

namespace patterns\Decorator2;

class LogRequest extends ProcessRequestDecorator
{
    public function process(RequestHelper $request)
    {
        echo static::class . ': логирование запроса<br>';
        $this->processRequest->process($request);
    }
}
