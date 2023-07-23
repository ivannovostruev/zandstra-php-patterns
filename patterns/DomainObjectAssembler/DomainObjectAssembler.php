<?php

namespace patterns\DomainObjectAssembler;

use PDO;
use PDOStatement;

class DomainObjectAssembler
{
    protected static PDO $PDO;
    protected PersistenceFactory $factory;
    protected array $statements = [];

    /**
     * @param PersistenceFactory $factory
     * @throws AppException
     */
    public function __construct(PersistenceFactory $factory)
    {
        $this->init();
        $this->factory = $factory;
    }

    /**
     * @param IdentityObject $object
     * @return DomainObject
     */
    public function findOne(IdentityObject $object): DomainObject
    {
        return $this->find($object)->next();
    }

    /**
     * @param IdentityObject $object
     * @return Collection
     */
    public function find(IdentityObject $object): Collection
    {
        $querySelectionFactory = $this->factory->getSelectionFactory();
        [$selection, $values] = $querySelectionFactory->newSelection($object);
        $statement = $this->getStatement($selection);
        $statement->execute($values);
        $rows = $statement->fetchAll();
        return $this->factory->getCollection($rows);
    }

    /**
     * @param DomainObject $object
     */
    public function insert(DomainObject $object): void
    {
        $updateFactory = $this->factory->getUpdateFactory();
        [$update, $values] = $updateFactory->newUpdate($object);
        $statement = $this->getStatement($update);
        $statement->execute($values);
        if (empty($object->getId())) {
            $object->setId($this->lastInsertId());
        }
        $object->markClean();
    }

    /**
     * @throws AppException
     */
    protected function init(): void
    {
        if (isset(self::$PDO)) {
            return;
        }

        $dsn = $this->getDSN();
        $this->guardDsnExists($dsn);
        self::$PDO = new PDO($dsn);

        $this->setSetAttribute();
    }

    protected function setSetAttribute(): void
    {
        self::$PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    /**
     * @param string $sql
     * @return PDOStatement
     */
    protected function getStatement(string $sql): PDOStatement
    {
        $this->saveStatementIfDoesntExist($sql);
        return $this->statements[$sql];
    }

    /**
     * @param string $sql
     */
    protected function saveStatementIfDoesntExist(string $sql): void
    {
        if (!isset($this->statements[$sql])) {
            $this->statements[$sql] = $this->prepare($sql);
        }
    }

    /**
     * @param string $sql
     * @return PDOStatement
     */
    protected function prepare(string $sql): PDOStatement
    {
        return self::$PDO->prepare($sql);
    }

    /**
     * @return int
     */
    protected function lastInsertId(): int
    {
        return (int) self::$PDO->lastInsertId();
    }

    /**
     * @return string|null
     */
    private function getDSN(): ?string
    {
        return ApplicationRegistry::getDSN();
    }

    /**
     * @param string|null $dsn
     * @throws AppException
     */
    private function guardDsnExists(?string $dsn): void
    {
        if (is_null($dsn)) {
            throw new AppException('DSN not defined');
        }
    }
}
