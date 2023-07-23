<?php

namespace patterns\IdentityObject;

use PDOStatement;

class VenueMapper extends Mapper
{
    protected PDOStatement $selectAllStatement;
    protected PDOStatement $selectStatement;
    protected PDOStatement $updateStatement;
    protected PDOStatement $insertStatement;

    public function __construct()
    {
        parent::__construct();

        $this->setSelectAllStatement();
        $this->setSelectStatement();
        $this->setInsertStatement();
        $this->setUpdateStatement();
    }

    protected function setSelectAllStatement(): void
    {
        $this->selectAllStatement = $this->prepare($this->getSelectAllQuery());
    }

    protected function setSelectStatement(): void
    {
        $this->selectStatement = $this->prepare($this->getSelectQuery());
    }

    protected function setInsertStatement(): void
    {
        $this->insertStatement = $this->prepare($this->getInsertQuery());
    }

    protected function setUpdateStatement(): void
    {
        $this->updateStatement = $this->prepare($this->getUpdateQuery());
    }

    protected function selectStatement(): PDOStatement
    {
        return $this->selectStatement;
    }

    protected function selectAllStatement(): PDOStatement
    {
        return $this->selectAllStatement;
    }

    protected function getSelectAllQuery(): string
    {
        return "SELECT * FROM venue";
    }

    protected function getSelectQuery(): string
    {
        return "SELECT * FROM venue WHERE id = ?";
    }

    protected function getInsertQuery(): string
    {
        return "INSERT INTO venue (name) values (?)";
    }

    protected function getUpdateQuery(): string
    {
        return "UPDATE venue SET name = ?, id = ? WHERE id = ?";
    }

    /**
     * @param array $raw
     * @return Collection
     */
    public function getCollection(array $raw): Collection
    {
        return new VenueCollection($raw, $this);
    }

    protected function doInsert(DomainObject $object)
    {
        $values = [$object->getName()];
        $this->insertStatement->execute($values);
        $id = self::$PDO->lastInsertId();
        $object->setId($id);
    }

    public function update(DomainObject $object)
    {
        $values = [
            $object->getName(),
            $object->getId(),
            $object->getId()
        ];
        $this->updateStatement->execute($values);
    }

    protected function getTargetClass(): string
    {
        return static::class;
    }
}
