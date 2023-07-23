<?php

namespace patterns\DomainObjectAssembler;

abstract class PersistenceFactory
{
    abstract public function getCollection(array $raw): Collection;
    abstract public function getDomainObjectFactory(): DomainObjectFactory;
    abstract public function getSelectionFactory(): SelectionFactory;
    abstract public function getUpdateFactory(): UpdateFactory;

    /**
     * @param string $type
     * @return PersistenceFactory
     * @throws AppException
     */
    public static function getFactory(string $type): self
    {
        return match ($type) {
            Space::class => new SpacePersistenceFactory(),
            Venue::class => new VenuePersistenceFactory(),
            default => throw new AppException('PersistenceFactory not defined'),
        };
    }
}
