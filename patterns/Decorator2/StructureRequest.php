<?php

namespace patterns\Decorator2;

class StructureRequest extends ProcessRequestDecorator
{
    public function process(RequestHelper $request)
    {
        echo static::class . ': упорядочивание данных запроса<br>';
        $this->processRequest->process($request);
    }
}
