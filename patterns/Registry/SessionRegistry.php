<?php

namespace patterns\Registry;

class SessionRegistry extends Registry
{
    private static ?self $instance = null;

    private function __construct()
    {
        session_start();
    }

    public static function getInstance(): self
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    protected function get(string $key)
    {
        return $_SESSION[__CLASS__][$key] ?? null;
    }

    protected function set(string $key, $value)
    {
        $_SESSION[__CLASS__][$key] = $value;
    }

    public function setDSN(string $dsn): void
    {
        self::getInstance()->set('dsn', $dsn);
    }

    public function getDSN(): ?string
    {
        return self::getInstance()->get('dsn');
    }
}
