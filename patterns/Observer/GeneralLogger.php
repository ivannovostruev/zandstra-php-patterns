<?php

namespace patterns\Observer;

class GeneralLogger extends LoginObserver
{
    public function doUpdate(Login $login)
    {
        $status = $login->getStatus();
        // Зарегистрируем подключение в журнале(логе)
        echo static::class . ': Регистрация в системном логе<br>';
    }
}
