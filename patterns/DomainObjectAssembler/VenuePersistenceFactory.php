<?php

namespace patterns\DomainObjectAssembler;

class VenuePersistenceFactory extends PersistenceFactory
{
    /**
     * @param array $raw
     * @return Collection
     */
    public function getCollection(array $raw): Collection
    {
        return new VenueCollection($raw, $this->getDomainObjectFactory());
    }

    /**
     * @return DomainObjectFactory
     */
    public function getDomainObjectFactory(): DomainObjectFactory
    {
        return new VenueDomainObjectFactory();
    }
}
