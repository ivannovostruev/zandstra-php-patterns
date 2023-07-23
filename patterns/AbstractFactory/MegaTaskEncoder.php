<?php

namespace patterns\AbstractFactory;

class MegaTaskEncoder extends TaskEncoder
{
    public function encode(): string
    {
        return 'Данные о задаче закодированы в формате MegaCalendar<br>';
    }
}
