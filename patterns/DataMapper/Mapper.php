<?php

namespace patterns\DataMapper;

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
        return $this->doCreateObject($data);
    }

    public function insert(DomainObject $object)
    {
        $this->doInsert($object);
    }
}
