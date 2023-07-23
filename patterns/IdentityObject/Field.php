<?php

namespace patterns\IdentityObject;

class Field
{
    protected string $name;
    protected array $conditions = [];
    protected bool $incomplete = false; //неполный

    /**
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function addCondition(string $operator, string $value)
    {
        $this->conditions[] = [
            'name'      => $this->name,
            'operator'  => $operator,
            'value'     => $value,
        ];
        $this->incomplete = true;
    }

    public function getConditions(): array
    {
        return $this->conditions;
    }

    public function isIncomplete(): bool
    {
        return empty($this->conditions);
    }
}
