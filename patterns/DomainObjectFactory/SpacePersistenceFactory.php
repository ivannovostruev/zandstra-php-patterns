<?php

namespace patterns\DomainObjectFactory;

class SpacePersistenceFactory extends PersistenceFactory
{
    /**
     * @param array $raw
     * @return Collection
     */
    public function getCollection(array $raw): Collection
    {
        return new SpaceCollection($raw, $this->getDomainObjectFactory());
    }

    /**
     * @return DomainObjectFactory
     */
    public function getDomainObjectFactory(): DomainObjectFactory
    {
        return new SpaceDomainObjectFactory();
    }
}
