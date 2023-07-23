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

    public function addParam(string $key, $value): void
    {
        $this->params[$key] = $value;
    }

    public function get(string $key): ?string
    {
        return $this->params[$key] ?? null;
    }

    public function setError(string $error): void
    {
        $this->error = $error;
    }

    public function getError(): string
    {
        return $this->error;
    }
}
