<?php

namespace patterns\Observer;

class PartnershipTool extends LoginObserver
{
    public function doUpdate(Login $login)
    {
        $status = $login->getStatus();
        // Проверяем IP
        // Отправляем cookie-файл, если адрес соответствует списку
        echo static::class . ': Отправка cookie-файла, если адрес соответствует списку<br>';
    }
}
