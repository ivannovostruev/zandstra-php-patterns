<?php

namespace patterns\Registry;

class MemApplicationRegistry extends Registry
{
    private $id;
    private array $values = [];
    private static ?self $instance = null;

    private function __construct(){}

    public static function getInstance(): self
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    protected function get(string $key)
    {
        return \apcu_fetch($key);
    }

    protected function set(string $key, $value)
    {
        return \apcu_store($key, $value);
    }

    /**
     * @param string $dsn
     */
    public function setDSN(string $dsn): void
    {
        self::getInstance()->set('dsn', $dsn);
    }

    /**
     * @return string|null
     */
    public function getDSN(): ?string
    {
        return self::getInstance()->get('dsn');
    }
}
