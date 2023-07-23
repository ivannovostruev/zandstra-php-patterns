<?php

namespace patterns\FrontController;

class ApplicationHelper
{
    private static ?self $instance = null;

    private string $config = 'options.php';

    private function __construct(){}

    public static function getInstance(): self
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function init(): void
    {
        $dsn = ApplicationRegistry::getDSN();
        if (isset($dsn)) {
            return;
        }
        $this->getOptions();
    }

    private function getOptions()
    {
        $this->ensure(file_exists(
            __DIR__ . DIRECTORY_SEPARATOR . $this->config),
            'Файл конфигурации не найден'
        );
        $options = require_once $this->config;

        $dsn = (string) $options['dsn'];
        $this->ensure(is_array($options), 'Файл конфигурации не является массивом');
        $this->ensure($dsn, 'DSN не найден');

        ApplicationRegistry::setDSN($dsn);
    }

    private function ensure(bool $expression, string $message): void
    {
        if (!$expression) {
            throw new AppException($message);
        }
    }
}
