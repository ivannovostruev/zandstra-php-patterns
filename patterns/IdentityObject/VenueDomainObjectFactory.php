<?php

namespace patterns\IdentityObject;

class VenueDomainObjectFactory extends DomainObjectFactory
{
    public function createObject(array $data): DomainObject
    {
        $existObject = $this->getFromMap($data['id']);
        if (isset($existObject)) {
            return $existObject;
        }

        $object = new Venue($data['id']);
        $object->setName($data['name']);
        $spaceMapper = new SpaceMapper();
        $spaceCollection = $spaceMapper->findByVenue((int) $data['id']);
        $object->setSpaces($spaceCollection);

        $this->addToMap($object);
        $object->markClean();
        return $object;
    }

    public function getTargetClass(): string
    {
        return Venue::class;
    }
}
