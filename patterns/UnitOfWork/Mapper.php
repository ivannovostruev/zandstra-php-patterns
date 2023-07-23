<?php

namespace patterns\UnitOfWork;

use PDO;
use PDOStatement;

abstract class Mapper
{
    protected static PDO $PDO;

    abstract public function update(DomainObject $object);
    abstract protected function doCreateObject(array $data): DomainObject;
    abstract protected function doInsert(DomainObject $object);
    abstract protected function selectStatement(): PDOStatement;

    abstract protected function selectAllStatement(): PDOStatement;
    abstract public function getCollection(array $raw): Collection;

    abstract protected function targetClass();

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

    public function findAll()
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

    public function insert(DomainObject $object)
    {
        $this->doInsert($object);
        $this->addToMap($object);
    }

    private function getFromMap(int $id): ?DomainObject
    {
        return ObjectWatcher::exists($this->targetClass(), $id);
    }

    private function addToMap(DomainObject $object): void
    {
        ObjectWatcher::add($object);
    }
}
