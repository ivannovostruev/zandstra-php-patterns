<?php

namespace patterns\IdentityMap;

use Exception;
use Iterator;

abstract class Collection implements Iterator
{
    protected ?Mapper $mapper;
    protected int $total = 0;
    protected array $raw = [];

    private int $pointer = 0;
    private array $objects = [];

    /**
     * @param array $raw
     * @param Mapper|null $mapper
     */
    public function __construct(array $raw = [], Mapper $mapper = null)
    {
        if (!empty($raw) && isset($mapper)) {
            $this->raw = $raw;
            $this->total = count($raw);
        }
        $this->mapper = $mapper;
    }

    /**
     * @param DomainObject $object
     * @throws Exception
     */
    public function add(DomainObject $object): void
    {
        $class = $this->targetClass();
        if (!$object instanceof $class) {
            throw new Exception('This is collection ' . $class);
        }
        $this->notifyAccess();
        $this->objects[$this->total] = $object;
        $this->total++;
    }

    abstract public function targetClass(): string;

    protected function notifyAccess()
    {
        // empty
    }

    /**
     * @param int $num
     * @return DomainObject|null
     */
    private function getRow(int $num): ?DomainObject
    {
        $this->notifyAccess();

        if ($num >= $this->total || $num < 0) {
            return null;
        }

        if (isset($this->objects[$num])) {
            return $this->objects[$num];
        }

        if (!isset($this->raw[$num])) {
            return null;
        }
        $this->objects[$num] = $this->mapper->createObject($this->raw[$num]);
        return $this->objects[$num];
    }

    public function current()
    {
        return $this->getRow($this->pointer);
    }

    public function next()
    {
        $row = $this->getRow($this->pointer);
        if ($row) {
            $this->pointer++;
        }
        return $row;
    }

    public function key()
    {
        return $this->pointer;
    }

    public function valid()
    {
        return !is_null($this->current());
    }

    public function rewind()
    {
        $this->pointer = 0;
    }
}
