<?php

namespace patterns\IdentityObject;

abstract class PersistenceFactory
{
    abstract public function getCollection(array $raw): Collection;
    abstract public function getDomainObjectFactory(): DomainObjectFactory;

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
