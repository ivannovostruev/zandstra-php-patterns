<?php

class Autoloader
{
    public static function register(): void
    {
        spl_autoload_register([self::class, 'loadClass']);
    }

    /**
     * @param string $className
     */
    private static function loadClass(string $className)
    {
        $transformedClassName = str_replace('\\', DIRECTORY_SEPARATOR, $className);
        $fileName = __DIR__ . DIRECTORY_SEPARATOR . $transformedClassName . '.php';
        if (file_exists($fileName)) {
            require_once($fileName);
        }
    }

    /**
     * @param string $fileName
     * @throws Exception
     */
    private static function guardFileIsFound(string $fileName): void
    {
        if (!file_exists($fileName)) {
            throw new Exception('Файл ' . $fileName . ' не найден');
        }
    }

    /**
     * @param string $fullyQualifiedClassName
     * @param string $unqualifiedClassName
     * @throws Exception
     */
    private static function guardClassExists(string $fullyQualifiedClassName, string $unqualifiedClassName): void
    {
        if (!class_exists($fullyQualifiedClassName)) {
            throw new Exception('Класс ' . $unqualifiedClassName . ' не найден');
        }
    }
}

Autoloader::register();
