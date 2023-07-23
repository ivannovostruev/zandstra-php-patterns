<?php

namespace patterns\UnitOfWork;

class Space extends DomainObject
{
    private string $name;
    private Venue $venue;

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

    public function setVenue(Venue $venue): void
    {
        $this->venue = $venue;
        $this->markDirty();
    }
}
