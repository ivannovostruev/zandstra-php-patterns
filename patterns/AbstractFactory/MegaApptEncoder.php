<?php

namespace patterns\AbstractFactory;

class MegaApptEncoder extends ApptEncoder
{

    /**
     * @return mixed
     */
    public function encode()
    {
        return 'Данные о встрече закодированы в формате MegaCal<br>';
    }
}
