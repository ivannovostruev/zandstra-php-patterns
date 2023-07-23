<?php

namespace patterns\DomainObjectAssembler;

class VenueUpdateFactory extends UpdateFactory
{
    /**
     * @param Venue $object
     * @return array
     */
    public function newUpdate(DomainObject $object): array
    {
        return $this->buildStatement(
            $this->getTable(),
            $this->getFields($object),
            $this->getConditions($object)
        );
    }

    /**
     * @return string
     */
    private function getTable(): string
    {
        return 'venue';
    }

    /**
     * @param Venue $object
     * @return array
     */
    private function getFields(DomainObject $object): array
    {
        $fields = [];
        $fields['name'] = $object->getName();
        return $fields;
    }

    /**
     * @param Venue $object
     * @return array
     */
    private function getConditions(DomainObject $object): array
    {
        $conditions = [];
        $id = $object->getId();
        if (isset($id)) {
            $conditions['id'] = $id;
        }
        return $conditions;
    }
}
