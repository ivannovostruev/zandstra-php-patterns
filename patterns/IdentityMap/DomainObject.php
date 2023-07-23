<?php

namespace patterns\IdentityMap;

abstract class DomainObject
{
    private int $id;

    public function __construct(?int $id = null)
    {
        $this->id = $id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

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
