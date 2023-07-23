<?php

namespace patterns\Command;

use Exception;

class CommandFactory
{
    /**
     * @var string Каталог, в котором лежат классы командных объектов
     */
    private static string $directory = 'Commands';

    /**
     * @param string $action
     * @return mixed
     * @throws Exception
     */
    public static function getCommand(string $action = 'Default'): Command
    {
        self::guardActionIsCorrect($action);

        $unqualifiedClassName = self::getUnqualifiedClassName($action);
        $qualifiedClassName = self::getQualifiedClassName($unqualifiedClassName);

        return new $qualifiedClassName();
    }

    /**
     * @param string $action
     * @return string
     */
    private static function getUnqualifiedClassName(string $action): string
    {
        $transformedAction = str_replace('_', '', ucwords($action, '_'));
        return $transformedAction . 'Command';
    }

    /**
     * @param string $unqualifiedClassName
     * @return string
     */
    private static function getQualifiedClassName(string $unqualifiedClassName): string
    {
        return self::$directory . '\\' . $unqualifiedClassName;
    }

    /**
     * @param string $action
     * @throws Exception
     */
    private static function guardActionIsCorrect(string $action): void
    {
        if (preg_match('/\W/', $action)) {
            throw new Exception('Недопустимые символы в названии команды');
        }
    }
}
