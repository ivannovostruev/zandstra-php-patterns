<?php

namespace patterns\DataMapper;

use Exception;
use Iterator;

abstract class CollectionWithGenerator
{
    protected ?Mapper $mapper;
    protected int $total = 0;
    protected array $raw = [];
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

    public function getGenerator(): \Generator
    {
        for ($x = 0; $x < $this->total; $x++) {
            yield $this->getRow($x);
        }
    }

    abstract public function targetClass();

    protected function notifyAccess()
    {
        // empty
    }

    private function getRow(int $num): ?DomainObject
    {
        $this->notifyAccess();

        if ($num >= $this->total || $num < 0) {
            return null;
        }

        if (isset($this->objects[$num])) {
            return $this->objects[$num];
        }

        if (isset($this->raw[$num])) {
            $this->objects[$num] = $this->mapper->createObject($this->raw[$num]);
            return $this->objects[$num];
        }
        return null;
    }
}
