<?php

namespace patterns\AbstractFactory;

class BloggsApptEncoder extends ApptEncoder
{
    public function encode()
    {
        return 'Данные о встрече закодированы в формате BloggsCal<br>';
    }
}
