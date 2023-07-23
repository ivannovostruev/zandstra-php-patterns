<?php

class Autoloader
{
    public static function register(): void
    {
        spl_autoload_register([self::class, 'loadClass']);
    }

    private static function loadClass(string $className): void
    {
        $transformedClassName = str_replace('\\', DIRECTORY_SEPARATOR, $className);
        $fileName = __DIR__ . DIRECTORY_SEPARATOR . $transformedClassName . '.php';
        if (file_exists($fileName)) {
            require_once($fileName);
        }
    }

    /**
     * @throws Exception
     */
    private static function guardFileIsFound(string $fileName): void
    {
        if (!file_exists($fileName)) {
            throw new Exception('File ' . $fileName . ' not found');
        }
    }

    /**
     * @throws Exception
     */
    private static function guardClassExists(
        string $fullyQualifiedClassName,
        string $unqualifiedClassName
    ): void {
        if (!class_exists($fullyQualifiedClassName)) {
            throw new Exception('Class ' . $unqualifiedClassName . ' not found');
        }
    }
}

Autoloader::register();
