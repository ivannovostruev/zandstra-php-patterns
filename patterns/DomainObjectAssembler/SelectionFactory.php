<?php

namespace patterns\DomainObjectAssembler;

abstract class SelectionFactory
{
    /**
     * @param IdentityObject $object
     * @return array
     */
    abstract public function newSelection(IdentityObject $object): array;

    /**
     * @param IdentityObject $object
     * @return array
     */
    protected function buildWhere(IdentityObject $object): array
    {
        if ($object->isVoid()) {
            return ['', []];
        }
        [$conditions, $values] = $this->getConditionsAndValues($object);
        $where = 'WHERE ' . implode(' AND ', $conditions);
        return [$where, $values];
    }

    /**
     * @param IdentityObject $object
     * @return array[]
     */
    private function getConditionsAndValues(IdentityObject $object): array
    {
        $conditions = $values = [];
        foreach ($object->getConditions() as $condition) {
            $conditions[] = $condition['name'] . ' ' . $condition['operator'] . ' ?';
            $values[] = $condition['value'];
        }
        return [$conditions, $values];
    }
}
