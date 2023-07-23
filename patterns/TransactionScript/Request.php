<?php

namespace patterns\TransactionScript;

class Request
{
    private array $properties;

    private array $feedback = [];

    public function __construct()
    {
        $this->init();
    }

    private function init()
    {
        if (isset($_SERVER['REQUEST_METHOD'])) {
            $this->properties = $_REQUEST;
            return;
        }
        foreach ($_SERVER['argv'] as $arg) {
            if (strpos($arg, '=')) {
                [$key, $value] = explode('=', $arg);
                $this->setProperty($key, $value);
            }
        }
    }

    public function getProperty(string $key)
    {
        return $this->properties[$key] ?? null;
    }

    public function setProperty(string $key, $value): void
    {
        $this->properties[$key] = $value;
    }

    public function addFeedback(string $message): void
    {
        array_push($this->feedback, $message);
    }

    public function getFeedback(): array
    {
        return $this->feedback;
    }

    public function getFeedbackToString(string $separator = "\n"): string
    {
        return implode($separator, $this->feedback);
    }
}
