<?php

namespace patterns\DomainObjectAssembler;

use PDOStatement;

class EventMapper extends Mapper
{
    protected PDOStatement $selectAllStatement;
    protected PDOStatement $selectStatement;
    protected PDOStatement $updateStatement;
    protected PDOStatement $insertStatement;
    protected PDOStatement $findBySpaceIdStatement;

    public function __construct()
    {
        parent::__construct();

        $this->setSelectAllStatement();
        $this->setSelectStatement();
        $this->setInsertStatement();
        $this->setUpdateStatement();
        $this->setFindBySpaceIdStatement();
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

    protected function setFindBySpaceIdStatement(): void
    {
        $this->findBySpaceIdStatement = $this->prepare($this->getFindBySpaceIdQuery());
    }

    protected function findBySpaceIdStatement(): PDOStatement
    {
        return $this->findBySpaceIdStatement;
    }

    protected function selectStatement(): PDOStatement
    {
        return $this->selectStatement;
    }

    protected function selectAllStatement(): PDOStatement
    {
        return $this->selectAllStatement;
    }

    private function getSelectAllQuery(): string
    {
        return "SELECT * FROM event";
    }

    private function getSelectQuery(): string
    {
        return "SELECT * FROM event WHERE id = ?";
    }

    private function getInsertQuery(): string
    {
        return "INSERT INTO event (name) values (?)";
    }

    private function getUpdateQuery(): string
    {
        return "UPDATE event SET name = ?, id = ? WHERE id = ?";
    }

    private function getFindBySpaceIdQuery(): string
    {
        return "SELECT * FROM event WHERE space = ?";
    }

    public function update(DomainObject $object)
    {
        // TODO: Implement update() method.
    }

    public function findBySpaceId(int $id): EventCollection
    {
        return new LazyLoadEventCollection(
            $this,
            $this->findBySpaceIdStatement(),
            [$id]
        );
    }

    protected function doCreateObject(array $data): DomainObject
    {
    }

    protected function doInsert(DomainObject $object)
    {
        // TODO: Implement doInsert() method.
    }

    public function getCollection(array $raw): Collection
    {
        return new SpaceCollection($raw, $this);
    }

    protected function getTargetClass(): string
    {
        return static::class;
    }
}
