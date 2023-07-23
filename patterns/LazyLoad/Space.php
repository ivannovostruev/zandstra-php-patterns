<?php

namespace patterns\LazyLoad;

class Space extends DomainObject
{
    private string $name;
    private Venue $venue;
    private EventCollection $events;

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

    public function setEvents(EventCollection $events)
    {
        $this->events = $events;
        $this->markDirty();
    }
}
