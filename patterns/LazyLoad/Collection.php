<?php

namespace patterns\LazyLoad;

use Exception;
use Iterator;

abstract class Collection implements Iterator
{
    protected array $raw = [];
    private array $objects = [];

    protected ?Mapper $mapper;

    private int $pointer = 0;
    protected int $total = 0;

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

    abstract public function getTargetClass(): string;

    protected function notifyAccess(): void
    {
    }

    /**
     * @param DomainObject $object
     * @throws Exception
     */
    public function add(DomainObject $object): void
    {
        $class = $this->getTargetClass();
        if (!$object instanceof $class) {
            throw new Exception('This is collection ' . $class);
        }
        $this->notifyAccess();
        $this->objects[$this->total] = $object;
        $this->total++;
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

    /**
     * @return mixed|DomainObject|null
     */
    public function current()
    {
        return $this->getRow($this->pointer);
    }

    /**
     * @return DomainObject|void|null
     */
    public function next()
    {
        $row = $this->getRow($this->pointer);
        if ($row) {
            $this->pointer++;
        }
        return $row;
    }

    /**
     * @return bool|float|int|string|null
     */
    public function key()
    {
        return $this->pointer;
    }

    /**
     * @return bool
     */
    public function valid()
    {
        return !is_null($this->current());
    }

    public function rewind()
    {
        $this->pointer = 0;
    }
}
