<?php

namespace patterns\DomainModel;

class Venue extends DomainObject
{
    private ?string $name;
    private Collection $spaces;

    /**
     * @param int|null $id
     * @param string|null $name
     */
    public function __construct(?int $id = null, ?string $name = null)
    {
        parent::__construct($id);

        $this->name = $name;
        $this->spaces = self::getCollection(static::class);
    }

    /**
     * @param SpaceCollection $spaces
     */
    public function setSpaces(SpaceCollection $spaces): void
    {
        $this->spaces = $spaces;
    }

    /**
     * @return Collection
     */
    public function getSpaces(): Collection
    {
        return $this->spaces;
    }

    public function addSpace(Space $space)
    {
        $this->spaces->add($space);
        $space->setVenue($this);
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
        $this->markDirty();
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }
}
