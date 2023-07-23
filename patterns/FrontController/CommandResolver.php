<?php

namespace patterns\FrontController;

use patterns\FrontController\command\Command;
use patterns\FrontController\command\DefaultCommand;
use patterns\FrontController\Request\Request;
use ReflectionClass;

class CommandResolver
{
    private static $baseCommand = null;
    private static $defaultCommand = null;

    public function __construct()
    {
        if (!isset(self::$baseCommand)) {
            self::$baseCommand = new ReflectionClass(Command::class);
            self::$defaultCommand = new DefaultCommand();
        }
    }
    public function getCommand(Request $request): Command
    {
        $command = $request->getProperty('cmd');
        $DS = DIRECTORY_SEPARATOR;
        if (!$command) {
            return self::$defaultCommand;
        }
        $command = str_replace(['.', $DS], '', $command);
        $filePath = 'command' . $DS . $command . '.php';
        $className = __NAMESPACE__ . '\\command\\' . $command;
        if (file_exists($filePath)) {
            require_once $filePath;
            if (class_exists($className)) {
                $commandClass = new ReflectionClass($className);
                if ($commandClass->isSubclassOf(self::$baseCommand)) {
                    $commandObj = $commandClass->newInstance();
                    /** @var Command $commandObj */
                    return $commandObj;
                } else {
                    $request->addFeedback('Объект Command команды "' . $command . '" не найден');
                }
            }
        }
        $request->addFeedback('Команда "' . $command . '" не найдена');

        return clone self::$defaultCommand;
    }
}
