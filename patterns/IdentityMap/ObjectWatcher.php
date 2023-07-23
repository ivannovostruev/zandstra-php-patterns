<?php

namespace patterns\IdentityMap;

class ObjectWatcher
{
    private array $all = [];
    private static ?self $instance = null;

    private function __construct(){}
    private function __clone(){}

    public static function getInstance(): self
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function globalKey(DomainObject $object): string
    {
        return get_class($object) . '.' . $object->getId();
    }

    public static function add(DomainObject $object): void
    {
        $instance = self::getInstance();
        $instance->all[$instance->globalKey($object)] = $object;
    }

    public static function exists(string $className, int $id): ?DomainObject
    {
        $instance = self::getInstance();
        $key = $className . '.' . $id;
        return $instance->all[$key] ?? null;
    }
}
