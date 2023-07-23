<?php

namespace patterns\IdentityObject;

class SpaceDomainObjectFactory extends DomainObjectFactory
{
    public function createObject(array $data): DomainObject
    {
        $existObject = $this->getFromMap($data['id']);
        if (isset($existObject)) {
            return $existObject;
        }

        $object = new Space($data['id']);
        $object->setName($data['name']);
        $venueMapper = new VenueMapper();
        $venue = $venueMapper->find($data['venue']);
        $object->setVenue($venue);
        $eventMapper = new EventMapper();
        $eventCollection = $eventMapper->findBySpaceId($data['id']);
        $object->setEvents($eventCollection);

        $this->addToMap($object);
        $object->markClean();
        return $object;
    }

    public function getTargetClass(): string
    {
        return Space::class;
    }
}
