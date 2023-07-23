<?php

namespace patterns\DomainObjectAssembler;

class VenueSelectionFactory extends SelectionFactory
{
    public function newSelection(IdentityObject $object): array
    {
        [$where, $values] = $this->buildWhere($object);
        $fields = implode(', ', $object->getAllowed());
        $query = $this->getQuery($fields, $where);
        return [$query, $values];
    }

    /**
     * @param string $fields
     * @param string $where
     * @return string
     */
    protected function getQuery(string $fields, string $where): string
    {
        return 'SELECT ' . $fields . ' FROM venue ' . $where;
    }
}
