<?php

namespace patterns\Command;

use Exception;

class CommandFactoryAlt
{
    private static string $directory = 'Commands';

    /**
     * @throws Exception
     */
    public static function getCommand(string $action = 'Default'): Command
    {
        self::guardActionIsCorrect($action);

        $unqualifiedClassName = self::getUnqualifiedClassName($action);
        $fileName = self::getClassFilename($unqualifiedClassName);
        self::guardFileIsFound($fileName);

        require_once $fileName;

        $fullyQualifiedClassName = self::getFullQualifiedClassName($unqualifiedClassName);
        self::guardClassExists($fullyQualifiedClassName, $unqualifiedClassName);

        return new $fullyQualifiedClassName();
    }

    private static function getUnqualifiedClassName(string $action): string
    {
        return ucfirst(strtolower($action)) . 'Command';
    }

    private static function getClassFilename(string $unqualifiedClassName): string
    {
        return self::$directory . DIRECTORY_SEPARATOR . $unqualifiedClassName . '.php';
    }

    private static function getFullQualifiedClassName(string $unqualifiedClassName): string
    {
        return '\\' . __NAMESPACE__ . '\\' . self::$directory . '\\' . $unqualifiedClassName;
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

    private static function guardFileIsFound(string $fileName): void
    {
        if (!file_exists($fileName)) {
            throw new CommandNotFoundException('Файл ' . $fileName . ' не найден');
        }
    }

    private static function guardClassExists(
        string $fullyQualifiedClassName,
        string $unqualifiedClassName
    ): void {
        if (!class_exists($fullyQualifiedClassName)) {
            throw new CommandNotFoundException('Класс ' . $unqualifiedClassName . ' не обнаружен');
        }
    }
}
