<?php

namespace patterns\Command;

use Exception;

class CommandFactory
{
    /**
     * Каталог, в котором лежат классы командных объектов
     */
    private static string $directory = 'Commands';

    /**
     * @throws Exception
     */
    public static function getCommand(string $action = 'Default'): Command
    {
        self::guardActionIsCorrect($action);

        $unqualifiedClassName = self::getUnqualifiedClassName($action);
        $qualifiedClassName = self::getQualifiedClassName($unqualifiedClassName);

        return new $qualifiedClassName();
    }

    private static function getUnqualifiedClassName(string $action): string
    {
        $transformedAction = str_replace('_', '', ucwords($action, '_'));
        return $transformedAction . 'Command';
    }

    private static function getQualifiedClassName(string $unqualifiedClassName): string
    {
        return self::$directory . '\\' . $unqualifiedClassName;
    }

    /**
     * @throws Exception
     */
    private static function guardActionIsCorrect(string $action): void
    {
        if (preg_match('/\W/', $action)) {
            throw new Exception('Недопустимые символы в названии команды');
        }
    }
}
