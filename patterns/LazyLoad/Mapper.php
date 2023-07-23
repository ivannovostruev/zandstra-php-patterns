<?php

namespace patterns\LazyLoad;

use PDO;
use PDOStatement;

abstract class Mapper
{
    protected static PDO $PDO;

    /**
     * @throws AppException
     */
    public function __construct()
    {
        if (!isset(self::$PDO)) {
            $dsn  = ApplicationRegistry::getDSN();
            if (is_null($dsn)) {
                throw new AppException('DSN not defined');
            }
            self::$PDO = new PDO($dsn);
            self::$PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
    }

    abstract public function update(DomainObject $object);
    abstract public function getCollection(array $raw): Collection;
    abstract protected function doCreateObject(array $data): DomainObject;
    abstract protected function doInsert(DomainObject $object);
    abstract protected function selectStatement(): PDOStatement;
    abstract protected function selectAllStatement(): PDOStatement;
    abstract protected function getTargetClass(): string;

    /**
     * @param string $sql
     * @return PDOStatement
     */
    protected function prepare(string $sql): PDOStatement
    {
        return self::$PDO->prepare($sql);
    }

    /**
     * @param int $id
     * @return DomainObject|null
     */
    public function find(int $id): ?DomainObject
    {
        $existObject = $this->getFromMap($id);
        if (isset($existObject)) {
            return $existObject;
        }

        $this->selectStatement()->execute([$id]);
        $row = $this->selectStatement()->fetch();
        $this->selectStatement()->closeCursor();
        return is_array($row) && isset($row['id'])
            ? $this->createObject($row)
            : null;
    }

    /**
     * @return Collection
     */
    public function findAll(): Collection
    {
        $this->selectAllStatement()->execute([]);
        return $this->getCollection(
            $this->selectAllStatement()->fetchAll(PDO::FETCH_ASSOC)
        );
    }

    /**
     * @param array $data
     * @return DomainObject
     */
    public function createObject(array $data): DomainObject
    {
        $existObject = $this->getFromMap($data['id']);
        if (isset($existObject)) {
            return $existObject;
        }

        $object = $this->doCreateObject($data);
        $this->addToMap($object);
        $object->markClean();
        return $object;
    }

    /**
     * @param DomainObject $object
     */
    public function insert(DomainObject $object)
    {
        $this->doInsert($object);
        $this->addToMap($object);
    }

    /**
     * @param int $id
     * @return DomainObject|null
     */
    private function getFromMap(int $id): ?DomainObject
    {
        return ObjectWatcher::exists($this->getTargetClass(), $id);
    }

    /**
     * @param DomainObject $object
     */
    private function addToMap(DomainObject $object): void
    {
        ObjectWatcher::add($object);
    }
}
