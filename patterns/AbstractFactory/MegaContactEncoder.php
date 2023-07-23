<?php

namespace patterns\AbstractFactory;

class MegaContactEncoder extends ContactEncoder
{
    public function encode(): string
    {
        return 'Данные о контакте закодированы в формате MegaCalendar<br>';
    }
}
