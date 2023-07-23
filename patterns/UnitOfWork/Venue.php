<?php

namespace patterns\UnitOfWork;

use Exception;

class Venue extends DomainObject
{
    private ?string $name;
    private ?Collection $spaces;

    public function __construct(?int $id = null, ?string $name = null)
    {
        parent::__construct($id);

        $this->name = $name;
        $this->spaces = self::getCollection(static::class);
    }

    public function setSpaces(SpaceCollection $spaces): void
    {
        $this->spaces = $spaces;
        $this->markDirty();
    }

    public function getSpaces(): Collection
    {
        if (!isset($this->spaces)) {
            $this->spaces = self::getCollection(Space::class);
        }
        return $this->spaces;
    }

    /**
     * @throws Exception
     */
    public function addSpace(Space $space)
    {
        $this->getSpaces()->add($space);
        $space->setVenue($this);
    }

    public function setName(string $name): void
    {
        $this->name = $name;
        $this->markDirty();
    }

    public function getName(): ?string
    {
        return $this->name;
    }
}
