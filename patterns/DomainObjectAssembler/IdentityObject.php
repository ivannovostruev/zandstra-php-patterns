<?php

namespace patterns\DomainObjectAssembler;

use Exception;

class IdentityObject
{
    protected ?Field $currentField = null;

    /**
     * @var Field[]
     */
    protected array $fields = [];

    private array $allowed = [];

    /**
     * @param string|null $fieldName
     * @param array $allowedFields
     * @throws Exception
     */
    public function __construct(string $fieldName = null, array $allowedFields = [])
    {
        $this->allowed = $allowedFields;

        if (isset($fieldName)) {
            $this->addField($fieldName);
        }
    }

    /**
     * @return bool
     */
    public function isVoid(): bool
    {
        return empty($this->fields);
    }

    /**
     * @return array
     */
    public function getAllowed(): array
    {
        return $this->allowed;
    }

    /**
     * @param string $fieldName
     * @return $this
     * @throws Exception
     */
    public function addField(string $fieldName): self
    {
        if (!$this->isVoid() && $this->currentField->isIncomplete()) {
            throw new Exception('Field is incomplete');
        }
        $this->guardFieldIsAllowed($fieldName);
        if (isset($this->fields[$fieldName])) {
            $this->currentField = $this->fields[$fieldName];
        } else {
            $this->currentField = new Field($fieldName);
            $this->fields[$fieldName] = $this->currentField;
        }
        return $this;
    }

    /**
     * @param string $value
     * @return $this
     * @throws Exception
     */
    public function equals(string $value): self
    {
        return $this->operator('=', $value);
    }

    /**
     * @param string $value
     * @return $this
     * @throws Exception
     */
    public function lessThan(string $value): self
    {
        return $this->operator('<', $value);
    }

    /**
     * @param string $value
     * @return $this
     * @throws Exception
     */
    public function moreThan(string $value): self
    {
        return $this->operator('>', $value);
    }

    /**
     * @param string $symbol
     * @param string $value
     * @return $this
     * @throws Exception
     */
    private function operator(string $symbol, string $value): self
    {
        if ($this->isVoid()) {
            throw new Exception('Field not defined');
        }
        $this->currentField->addCondition($symbol, $value);
        return $this;
    }

    /**
     * @return array
     */
    public function getConditions(): array
    {
        $conditions = [];
        foreach ($this->fields as $field) {
            $conditions = array_merge($conditions, $field->getConditions());
        }
        return $conditions;
    }

    /**
     * @param string $fieldName
     * @throws Exception
     */
    private function guardFieldIsAllowed(string $fieldName): void
    {
        if (!in_array($fieldName, $this->allowed) && !empty($this->allowed)) {
            $allowed = implode(', ', $this->allowed);
            throw new Exception('Field "' . $fieldName . '" is not allowed (' . $allowed . ')');
        }
    }
}
