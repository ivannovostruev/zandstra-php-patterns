<?php

namespace patterns\Registry;

class RequestRegistry extends Registry
{
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
        return $this->values[$key] ?? null;
    }

    protected function set(string $key, $value)
    {
        $this->values[$key] = $value;
    }

    /**
     * @return Request
     */
    public static function getRequest(): Request
    {
        $instance = self::getInstance();
        if (is_null($instance->get('request'))) {
            $instance->set('request', new Request());
        }
        return $instance->get('request');
    }
}
