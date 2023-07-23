<?php

namespace patterns\LazyLoad;

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

    public function markNew(): void
    {
        ObjectWatcher::addNew($this);
    }

    public function markDeleted(): void
    {
        ObjectWatcher::addDelete($this);
    }

    public function markDirty(): void
    {
        ObjectWatcher::addDirty($this);
    }

    public function markClean(): void
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

    /**
     * @param string|null $type
     * @return Collection
     */
    public static function getCollection(?string $type = null): Collection
    {
        return isset($type)
            ? HelperFactory::getCollection($type)
            : HelperFactory::getCollection(static::class);
    }

    /**
     * @return Collection
     */
    public function collection(): Collection
    {
        return self::getCollection(get_class($this));
    }

    /**
     * @return Mapper
     */
    public function mapper(): Mapper
    {
        return self::getMapper(get_class($this));
    }

    /**
     * @param string|null $type
     * @return Mapper
     */
    protected static function getMapper(string $type = null): Mapper
    {
        return isset($type)
            ? HelperFactory::getMapper($type)
            : HelperFactory::getMapper(static::class);
    }
}
