<?php

namespace patterns\FrontController;

use patterns\FrontController\Request\Request;

class ApplicationRegistry extends Registry
{
    private string $freezeDir = 'data';
    private array $values = [];
    private array $mtimes = [];
    private Request $request;
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
        $path = $this->freezeDir . DIRECTORY_SEPARATOR . $key;
        if (file_exists($path)) {
            clearstatcache();
            $mtime = filemtime($path);
            if (!isset($this->mtimes[$key])) {
                $this->mtimes[$key] = 0;
            }
            if ($mtime > $this->mtimes[$key]) {
                $data = file_get_contents($path);
                $this->mtimes[$key] = $mtime;
                return ($this->values[$key] = unserialize($data));
            }
        }
        return $this->values[$key] ?? null;
    }

    protected function set(string $key, $value)
    {
        $this->values[$key] = $value;
        $path = $this->freezeDir . DIRECTORY_SEPARATOR . $key;
        file_put_contents($path, serialize($value));
        $this->mtimes[$key] = time();
    }

    public static function setDSN(string $dsn): void
    {
        self::getInstance()->set('dsn', $dsn);
    }

    public static function getDSN(): ?string
    {
        return self::getInstance()->get('dsn');
    }

    public static function getRequest(): Request
    {
        $instance = self::getInstance();
        if (!isset($instance->request)) {
            $instance->request = new Request();
        }
        return $instance->request;
    }
}
