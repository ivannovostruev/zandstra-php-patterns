<?php

namespace patterns\DomainObjectFactory;

use PDOStatement;

class SpaceMapper extends Mapper
{
    protected PDOStatement $selectAllStatement;
    protected PDOStatement $selectStatement;
    protected PDOStatement $updateStatement;
    protected PDOStatement $insertStatement;
    protected PDOStatement $findByVenueStatement;

    public function __construct()
    {
        parent::__construct();

        $this->setSelectAllStatement();
        $this->setSelectStatement();
        $this->setInsertStatement();
        $this->setUpdateStatement();
        $this->setFindByVenueStatement();
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

    protected function setFindByVenueStatement(): void
    {
        $this->findByVenueStatement = $this->prepare($this->getFindByVenueQuery());
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
        return "SELECT * FROM space";
    }

    private function getSelectQuery(): string
    {
        return "SELECT * FROM space WHERE id = ?";
    }

    private function getInsertQuery(): string
    {
        return "INSERT INTO space (name) values (?)";
    }

    private function getUpdateQuery(): string
    {
        return "UPDATE space SET name = ?, id = ? WHERE id = ?";
    }

    private function getFindByVenueQuery(): string
    {
        return "SELECT * FROM space WHERE venue = ?";
    }

    public function update(DomainObject $object)
    {
        // TODO: Implement update() method.
    }

    public function findByVenue(int $id): SpaceCollection
    {
        $this->findByVenueStatement()->execute([$id]);
        return new SpaceCollection(
            $this->findByVenueStatement()->fetchAll(),
            $this
        );
    }

    protected function doInsert(DomainObject $object)
    {
        // TODO: Implement doInsert() method.
    }

    protected function findByVenueStatement(): PDOStatement
    {
        return $this->findByVenueStatement;
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
