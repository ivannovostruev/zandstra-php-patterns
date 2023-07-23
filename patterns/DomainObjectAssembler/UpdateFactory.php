<?php

namespace patterns\DomainObjectAssembler;

abstract class UpdateFactory
{
    /**
     * @param DomainObject $object
     * @return array
     */
    abstract public function newUpdate(DomainObject $object): array;

    /**
     * @param string $table
     * @param array $fields Ассоциативный массив названий полей и их значений
     * @param array $conditions
     * @return array
     */
    protected function buildStatement(
        string $table,
        array $fields,
        array $conditions = []
    ): array {
        return !empty($conditions)
            ? $this->buildUpdateStatement($table, $fields, $conditions)
            : $this->buildInsertStatement($table, $fields);
    }

    /**
     * @param string $tableName
     * @param array $fields
     * @param array $conditions
     * @return array
     */
    protected function buildUpdateStatement(
        string $tableName,
        array  $fields,
        array  $conditions
    ): array {
        [$conditionNames, $values] = $this->getConditionNamesAndValues($fields, $conditions);
        $fieldNames = array_keys($fields);
        $query = $this->getUpdateQuery($tableName, $fieldNames, $conditionNames);
        return [$query, $values];
    }

    /**
     * @param string $tableName
     * @param array $fields
     * @return array
     */
    protected function buildInsertStatement(string $tableName, array $fields): array
    {
        [$questions, $values] = $this->getQuestionsAndValuesFromFields($fields);
        $fieldNames = array_keys($fields);
        $query = $this->getInsertQuery($tableName, $fieldNames, $questions);
        return [$query, $values];
    }

    /**
     * @param string $tableName
     * @param array $fieldNames
     * @param array $conditionNames
     * @return string
     */
    protected function getUpdateQuery(
        string $tableName,
        array $fieldNames,
        array $conditionNames
    ): string {
        $query = 'UPDATE ' . $tableName . ' SET ';
        $query .= implode(' = ?, ', $fieldNames) . ' = ?';
        $query .= ' WHERE ';
        $query .= implode(' AND ', $conditionNames);

        return $query;
    }

    /**
     * @param string $tableName
     * @param array $fieldNames
     * @param array $questions
     * @return string
     */
    protected function getInsertQuery(
        string $tableName,
        array $fieldNames,
        array $questions
    ): string {
        $query = 'INSERT INTO ' . $tableName . ' (';
        $query .= implode(', ', $fieldNames);
        $query .= ') VALUES (';
        $query .= implode(', ', $questions);
        $query .= ')';

        return $query;
    }

    /**
     * @param array $fields
     * @param array $conditions
     * @return array
     */
    protected function getConditionNamesAndValues(array $fields, array $conditions): array
    {
        $conditionNames = [];
        $values = array_values($fields);
        foreach ($conditions as $key => $value) {
            $conditionNames[] = $key . ' = ?';
            $values[] = $value;
        }
        return [$conditionNames, $values];
    }

    /**
     * @param array $fields
     * @return array[]
     */
    protected function getQuestionsAndValuesFromFields(array $fields): array
    {
        $questions = $values = [];
        foreach ($fields as $value) {
            $values[] = $value;
            $questions[] = '?';
        }
        return [$questions, $values];
    }
}
