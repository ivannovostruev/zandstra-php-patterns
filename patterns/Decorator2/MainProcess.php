<?php

namespace patterns\Decorator2;

class MainProcess extends ProcessRequest
{
    public function process(RequestHelper $request)
    {
        echo static::class . ': выполнение запроса<br>';
    }
}
