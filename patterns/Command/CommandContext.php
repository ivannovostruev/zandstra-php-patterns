<?php

namespace patterns\Command;

class CommandContext
{
    private array $params;

    private string $error = '';

    public function __construct()
    {
        $this->params = $_REQUEST;
    }

    /**
     * @param string $key
     * @param $value
     */
    public function addParam(string $key, $value): void
    {
        $this->params[$key] = $value;
    }

    /**
     * @param string $key
     * @return string|null
     */
    public function get(string $key): ?string
    {
        return $this->params[$key] ?? null;
    }

    /**
     * @param string $error
     */
    public function setError(string $error): void
    {
        $this->error = $error;
    }

    /**
     * @return string
     */
    public function getError(): string
    {
        return $this->error;
    }
}
