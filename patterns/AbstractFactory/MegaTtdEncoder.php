<?php

namespace patterns\AbstractFactory;

class MegaTtdEncoder extends TtdEncoder
{
    /**
     * @return mixed
     */
    public function encode()
    {
        return 'Данные о задаче закодированы в формате MegaCal<br>';
    }
}
