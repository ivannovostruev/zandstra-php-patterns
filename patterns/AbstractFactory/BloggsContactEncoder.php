<?php

namespace patterns\AbstractFactory;

class BloggsContactEncoder extends ContactEncoder
{
    public function encode()
    {
        return 'Данные о контакте закодированы в формате BloggsCal<br>';
    }
}
