<?php

namespace patterns\UnitOfWork;

class ObjectWatcher
{
    private array $all = [];

    /**
     * Измененные объекты, ожидающие обновления в БД
     * Тут хранятся объекты, которые были изменены после извлечения из БД
     */
    private array $dirty = [];
    private array $new = [];
    private array $delete = [];

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

    public function getGlobalKey(DomainObject $object): string
    {
        return get_class($object) . '.' . $object->getId();
    }

    public static function add(DomainObject $object): void
    {
        $instance = self::getInstance();
        $instance->all[$instance->getGlobalKey($object)] = $object;
    }

    public static function exists(string $className, int $id): ?DomainObject
    {
        $instance = self::getInstance();
        $key = $className . '.' . $id;
        return $instance->all[$key] ?? null;
    }

    public static function addDelete(DomainObject $object): void
    {
        $instance = self::getInstance();
        $instance->delete[$instance->getGlobalKey($object)] = $object;
    }

    public static function addDirty(DomainObject $object): void
    {
        $instance = self::getInstance();
        if (!in_array($object, $instance->new, true)) {
            $instance->dirty[$instance->getGlobalKey($object)] = $object;
        }
    }

    public static function addNew(DomainObject $object): void
    {
        $instance = self::getInstance();
        // Так как в БД ещё не сохранён этот объект, то у нас ещё нет его id,
        // следовательно globalKey для него мы получить не можем
        $instance->new[] = $object;
    }

    public static function addClean(DomainObject $object): void
    {
        $instance = self::getInstance();

        $globalKey = $instance->getGlobalKey($object);

        unset($instance->delete[$globalKey]);
        unset($instance->dirty[$globalKey]);

        $instance->new = array_filter($instance->new, function ($value) use ($object) {
            return $value !== $object;
        });
    }

    public function performOperations(): void
    {
        foreach ($this->dirty as $key => $object) {
            $object->getMapper()->update($object);
        }

        foreach ($this->new as $key => $object) {
            $object->getMapper()->insert($object);
        }
        $this->dirty = [];
        $this->new = [];
    }
}
