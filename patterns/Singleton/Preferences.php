<?php

namespace patterns\Singleton;

class Preferences
{
    private static self $instance;

    private array $properties = [];

    private function __construct(){}

    public static function getInstance(): self
    {
        if (empty(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function setProperty($key, $value): void
    {
        $this->properties[$key] = $value;
    }

    public function getProperty($key): mixed
    {
        return $this->properties[$key] ?? null;
    }
}
