<?php

namespace patterns\AbstractFactory;

class BloggsTaskEncoder extends TaskEncoder
{
    public function encode(): string
    {
        return 'Данные о задаче закодированы в формате BloggsCalendar<br>';
    }
}
