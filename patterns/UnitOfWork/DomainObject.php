<?php

namespace patterns\UnitOfWork;

abstract class DomainObject
{
    private int $id;

    /**
     * @param int|null $id
     */
    public function __construct(?int $id = null)
    {
        if (!isset($id)) {
            $this->markNew();
        } else {
            $this->id = $id;
        }
    }

    public function markNew()
    {
        ObjectWatcher::addNew($this);
    }

    public function markDeleted()
    {
        ObjectWatcher::addDelete($this);
    }

    public function markDirty()
    {
        ObjectWatcher::addDirty($this);
    }

    public function markClean()
    {
        ObjectWatcher::addClean($this);
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    public static function getCollection(?string $type = null): Collection
    {
        return isset($type)
            ? HelperFactory::getCollection($type)
            : HelperFactory::getCollection(static::class);
    }

    public function collection(): Collection
    {
        return self::getCollection(get_class($this));
    }

    public function mapper(): Mapper
    {
        return self::getMapper(get_class($this));
    }

    protected static function getMapper(string $type = null): Mapper
    {
        return isset($type)
            ? HelperFactory::getMapper($type)
            : HelperFactory::getMapper(static::class);
    }
}
