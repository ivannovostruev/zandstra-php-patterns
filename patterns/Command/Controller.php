<?php

namespace patterns\Command;

use Exception;

class Controller
{
    private CommandContext $context;

    public function __construct()
    {
        $this->context = new CommandContext();
    }

    /**
     * @return CommandContext
     */
    public function getContext(): CommandContext
    {
        return $this->context;
    }

    /**
     * @throws Exception
     */
    public function process(): void
    {
        $action = $this->getAction();
        $command = CommandFactory::getCommand($action);

        if (!$command->execute($this->context)) {
            echo 'Обработка ошибки';
        } else {
            echo 'Всё прошло успешно, отображаем результаты';
        }
    }

    /**
     * @return string
     */
    private function getAction(): string
    {
        return $this->context->get('action') ?? 'default';
    }
}
