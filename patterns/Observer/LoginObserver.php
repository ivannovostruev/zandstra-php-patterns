<?php

namespace patterns\Observer;

use SplObserver;
use SplSubject;

abstract class LoginObserver implements SplObserver
{
    public function __construct(private readonly Login $login)
    {
        $login->attach($this);
    }

    public function update(SplSubject $subject): void
    {
        if ($subject === $this->login) {
            $this->doUpdate($subject);
        }
    }

    abstract public function doUpdate(Login $login);
}
