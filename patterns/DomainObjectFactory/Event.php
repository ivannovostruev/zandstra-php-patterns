<?php

namespace patterns\DomainObjectFactory;

class Event extends DomainObject
{
    private string $name;
    private Space $space;

    public function __construct(?int $id = null, ?string $name = null)
    {
        parent::__construct($id);
        $this->name = $name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
        $this->markDirty();
    }

    public function setSpace(Space $space): void
    {
        $this->space = $space;
        $this->markDirty();
    }
}
