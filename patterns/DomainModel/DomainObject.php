<?php

namespace patterns\DomainModel;

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
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    public static function getCollection(string $type): Collection
    {
        return new Collection();
    }

    public function collection()
    {
        return self::getCollection(get_class($this));
    }
}
