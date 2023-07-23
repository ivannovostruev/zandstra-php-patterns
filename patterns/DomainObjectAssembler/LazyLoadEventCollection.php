<?php

namespace patterns\DomainObjectAssembler;

use PDOStatement;

class LazyLoadEventCollection extends EventCollection
{
    private PDOStatement $statement;
    private array $values;
    private bool $run = false;

    /**
     * @param Mapper $mapper
     * @param PDOStatement $statementHandle
     * @param array $values
     */
    public function __construct(Mapper $mapper, PDOStatement $statementHandle, array $values)
    {
        parent::__construct(null, $mapper);

        $this->statement = $statementHandle;
        $this->values = $values;
    }

    public function notifyAccess(): void
    {
        if (!$this->run) {
            $this->statement->execute($this->values);
            $this->raw = $this->statement->fetchAll();
            $this->total = count($this->raw);
        }
        $this->run = true;
    }
}
