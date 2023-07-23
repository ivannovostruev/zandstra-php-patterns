<?php

namespace patterns\Decorator2;

class AuthenticateRequest extends ProcessRequestDecorator
{
    public function process(RequestHelper $request)
    {
        echo static::class . ': аутентификация запроса<br>';
        $this->processRequest->process($request);
    }
}
