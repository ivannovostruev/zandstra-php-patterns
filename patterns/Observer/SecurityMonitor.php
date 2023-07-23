<?php

namespace patterns\Observer;

class SecurityMonitor extends LoginObserver
{
    public function doUpdate(Login $login)
    {
        $status = $login->getStatus();
        if ($status[0] == Login::LOGIN_WRONG_PASS) {
            // Отправим почту системному администратору
            echo static::class . ': Отправка почты системному администратору<br>';
        }
    }
}
