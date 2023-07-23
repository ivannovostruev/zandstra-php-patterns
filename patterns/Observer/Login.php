<?php

namespace patterns\Observer;

use SplObjectStorage;
use SplObserver;
use SplSubject;

class Login implements SplSubject
{
    const LOGIN_USER_UNKNOWN = 1;
    const LOGIN_WRONG_PASS = 2;
    const LOGIN_ACCESS = 3;

    /**
     * @var SplObjectStorage
     */
    private SplObjectStorage $storage;

    /**
     * @var array
     */
    private array $status = [];

    /**
     * Login constructor.
     */
    public function __construct()
    {
        $this->storage = new SplObjectStorage();
    }

    /**
     * @param SplObserver $observer
     */
    public function attach(SplObserver $observer)
    {
        $this->storage->attach($observer);
    }

    /**
     * @param SplObserver $observer
     */
    public function detach(SplObserver $observer)
    {
        $this->storage->detach($observer);
    }

    public function notify()
    {
        foreach ($this->storage as $observer) {
            $observer->update($this);
        }
    }

    /**
     * @param $user
     * @param $pass
     * @param $ip
     * @return bool
     */
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

    /**
     * @return array
     */
    public function getStatus(): array
    {
        return $this->status;
    }

    /**
     * @param $status
     * @param $user
     * @param $ip
     */
    private function setStatus($status, $user, $ip): void
    {
        $this->status = [$status, $user, $ip];
    }
}










