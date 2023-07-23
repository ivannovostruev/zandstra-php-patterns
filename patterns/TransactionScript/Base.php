<?php

namespace patterns\TransactionScript;

use PDO;
use PDOException;
use PDOStatement;

class Base
{
    protected static PDO $db;

    protected static array $statements = [];

    /**
     * @throws AppException
     */
    public function __construct()
    {
        $dsn = ApplicationRegistry::getDSN();
        if (is_null($dsn)) {
            throw new AppException('DSN not defined');
        }
        self::$db = new PDO($dsn);
        self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    /**
     * @param string $statement
     * @return PDOStatement
     * @throws PDOException
     */
    public function prepareStatement(string $statement): PDOStatement
    {
        if (isset(self::$statements[$statement])) {
            return self::$statements[$statement];
        }
        $stmtHandle = self::$db->prepare($statement);
        self::$statements[$statement] = $stmtHandle;
        return $stmtHandle;
    }

    /**
     * @param string $statement
     * @param array $values
     * @return PDOStatement
     */
    public function doStatement(string $statement, array $values): PDOStatement
    {
        $sth = $this->prepareStatement($statement);
        $sth->closeCursor();
        $result = $sth->execute($values);
        return $sth;
    }
}
