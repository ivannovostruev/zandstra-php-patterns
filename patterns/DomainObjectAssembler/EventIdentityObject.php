<?php

namespace patterns\DomainObjectAssembler;

class EventIdentityObject extends IdentityObject
{
    public function __construct(string $fieldName = null)
    {
        parent::__construct($fieldName, ['id', 'name', 'start', 'duration', 'space']);
    }
}
