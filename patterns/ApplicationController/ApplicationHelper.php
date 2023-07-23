<?php

namespace patterns\ApplicationController;

use patterns\ApplicationController\Command\Command;
use patterns\ApplicationController\Controller\ControllerMap;

class ApplicationHelper
{
    private static ?self $instance = null;
    private string $config = 'options.xml';

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
        $options = simplexml_load_file($this->config);
        $dsn = (string) $options->dsn;

        $this->ensure(is_array($options), 'Файл конфигурации не является массивом');
        $this->ensure($dsn, 'DSN не найден');
        ApplicationRegistry::setDSN($dsn);

        $map = new ControllerMap();

        foreach ($options->control->view as $defaultView) {
            $statusName = trim($defaultView['status']);
            $status = Command::getStatuses($statusName);
            $map->addView((string) $defaultView, 'default', $status);
        }

        ApplicationRegistry::setControllerMap($map);
    }

    private function ensure(bool $expression, string $message): void
    {
        if (!$expression) {
            throw new AppException($message);
        }
    }
}
