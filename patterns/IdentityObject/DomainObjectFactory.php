<?php

namespace patterns\IdentityObject;

abstract class DomainObjectFactory
{
    abstract public function createObject(array $data): DomainObject;
    abstract public function getTargetClass(): string;

    /**
     * @param int $id
     * @return DomainObject|null
     */
    protected function getFromMap(int $id): ?DomainObject
    {
        return ObjectWatcher::exists($this->getTargetClass(), $id);
    }

    /**
     * @param DomainObject $object
     */
    protected function addToMap(DomainObject $object): void
    {
        ObjectWatcher::add($object);
    }
}
