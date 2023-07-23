<?php

namespace patterns\AbstractFactory;

class MegaContactEncoder extends ContactEncoder
{
    /**
     * @return mixed
     */
    public function encode()
    {
        return 'Данные о контакте закодированы в формате MegaCal<br>';
    }
}
