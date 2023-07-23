<?php

namespace patterns\Observer;

use SplObserver;
use SplSubject;

abstract class LoginObserver implements SplObserver
{
    private Login $login;

    public function __construct(Login $login)
    {
        $this->login = $login;
        $login->attach($this);
    }

    public function update(SplSubject $subject)
    {
        if ($subject === $this->login) {
            $this->doUpdate($subject);
        }
    }

    abstract public function doUpdate(Login $login);
}
