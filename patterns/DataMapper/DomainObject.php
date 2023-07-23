<?php

namespace patterns\DataMapper;

abstract class DomainObject
{
    private int $id;

    /**
     * @param int|null $id
     */
    public function __construct(?int $id = null)
    {
        $this->id = $id;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void
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
}
