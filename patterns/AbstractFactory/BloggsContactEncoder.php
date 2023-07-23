<?php

namespace patterns\AbstractFactory;

class BloggsContactEncoder extends ContactEncoder
{
    public function encode(): string
    {
        return 'Данные о контакте закодированы в формате BloggsCalendar<br>';
    }
}
