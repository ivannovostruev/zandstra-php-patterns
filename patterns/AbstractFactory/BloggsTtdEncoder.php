<?php

namespace patterns\AbstractFactory;

class BloggsTtdEncoder extends TtdEncoder
{
    public function encode()
    {
        return 'Данные о задаче закодированы в формате BloggsCal<br>';
    }
}
