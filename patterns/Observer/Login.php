<?php

namespace patterns\Observer;

use SplObjectStorage;
use SplObserver;
use SplSubject;

class Login implements SplSubject
{
    const LOGIN_USER_UNKNOWN    = 1;
    const LOGIN_WRONG_PASS      = 2;
    const LOGIN_ACCESS          = 3;

    private SplObjectStorage $storage;

    private array $status = [];

    public function __construct()
    {
        $this->storage = new SplObjectStorage();
    }

    public function attach(SplObserver $observer): void
    {
        $this->storage->attach($observer);
    }

    public function detach(SplObserver $observer): void
    {
        $this->storage->detach($observer);
    }

    public function notify(): void
    {
        foreach ($this->storage as $observer) {
            $observer->update($this);
        }
    }

    public function handleLogin($user, $pass, $ip): bool
    {
        $isValid = false;
        switch (rand(1, 3)) {
            case 1:
                $this->setStatus(self::LOGIN_ACCESS, $user, $ip);
                $isValid = true;
                break;
            case 2:
                $this->setStatus(self::LOGIN_WRONG_PASS, $user, $ip);
                $isValid = false;
                break;
            case 3:
                $this->setStatus(self::LOGIN_USER_UNKNOWN, $user, $ip);
                $isValid = false;
                break;
        }
        $this->notify();
        return $isValid;
    }

    public function getStatus(): array
    {
        return $this->status;
    }

    private function setStatus($status, $user, $ip): void
    {
        $this->status = [$status, $user, $ip];
    }
}
