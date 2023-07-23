<?php

namespace patterns\DomainObjectAssembler;

use Exception;
use Iterator;

abstract class Collection implements Iterator
{
    protected ?DomainObjectFactory $factory;

    protected array $raw = [];
    private array $objects = [];

    private int $pointer = 0;
    protected int $total = 0;

    /**
     * @param array $raw
     * @param DomainObjectFactory|null $factory
     */
    public function __construct(array $raw = [], DomainObjectFactory $factory = null)
    {
        if (!empty($raw) && isset($factory)) {
            $this->raw = $raw;
            $this->total = count($raw);
        }
        $this->factory = $factory;
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
     * @param int $number
     * @return DomainObject|null
     */
    private function getRow(int $number): ?DomainObject
    {
        $this->notifyAccess();

        if ($number >= $this->total || $number < 0) {
            return null;
        }

        if (isset($this->objects[$number])) {
            return $this->objects[$number];
        }

        if (!isset($this->raw[$number])) {
            return null;
        }
        $this->objects[$number] = $this->createObject($this->raw[$number]);
        return $this->objects[$number];
    }

    /**
     * @param array $data
     * @return DomainObject
     */
    private function createObject(array $data): DomainObject
    {
        return $this->factory->createObject($data);
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
