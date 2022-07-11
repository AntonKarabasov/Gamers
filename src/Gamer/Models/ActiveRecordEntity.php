<?php

namespace Gamer\Models;

use Gamer\Models\Games\Game;
use Gamer\Services\Db;

abstract class ActiveRecordEntity implements \JsonSerializable
{
    /** @var int */
    protected $id;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    public function __set(string $name, $value)
    {
        $camelCaseName = $this->underscoreToCamelCase($name);
        $this->$camelCaseName = $value;
    }

    private function mapPropertiesToDbFormat(): array
    {
        $reflector = new \ReflectionObject($this);
        $properties = $reflector->getProperties();

        $mappedProperties = [];
        foreach ($properties as $property) {
            $propertyName = $property->getName();
            $propertyNameAsUnderscore = $this->camelCaseToUnderscore($propertyName);
            $mappedProperties[$propertyNameAsUnderscore] = $this->$propertyName;
        }

        return $mappedProperties;

    }

    public function save(): void
    {
        $mappedProperties = $this->mapPropertiesToDbFormat();
        if ($this->id !== null) {
            $this->update($mappedProperties);
        } else {
            $this->insert($mappedProperties);
        }
    }

    private function update(array $mappedProperties): void
    {
        $columns2params = [];
        $params2values = [];
        $index = 1;
        foreach ($mappedProperties as $column => $value) {
            $param = ':param' . $index; // :param1
            $columns2params[] = $column . ' = ' . $param; // column1 = :param1
            $params2values[$param] = $value; // [:param1 => value1]
            $index++;
        }
        $sql = 'UPDATE ' . static::getTableName() . ' SET ' . implode(', ', $columns2params) . ' WHERE id =  ' .  $this->id;
        $db = Db::getInstance();
        $db->query($sql, $params2values, static::class);
    }

    protected function insert(array $mappedProperties): void
    {
        $filteredProperties = array_filter($mappedProperties);

        $columns = [];
        $paramsNames = [];
        $params2values = [];
        foreach ($filteredProperties as $columnName => $value) {
            $columns[] = '`' . $columnName . '`';
            $paramName = ':' . $columnName;
            $paramsNames[] = $paramName;
            $params2values[$paramName] = $value;
        }

        $columnsViaSemicolon = implode(', ', $columns);
        $paramsNamesViaSemicolon = implode(', ', $paramsNames);

        $sql = 'INSERT INTO ' . static::getTableName() . ' (' . $columnsViaSemicolon . ') VALUES (' . $paramsNamesViaSemicolon . ');';

        $db = Db::getInstance();
        $db->query($sql, $params2values, static::class);
        $this->id = $db->getLastInsertId();
        $this->refresh();
    }

    public function delete(): void
    {
        $sql = 'DELETE FROM ' . static::getTableName() . ' WHERE id = :id;';

        $db = Db::getInstance();
        $db->query($sql, [':id' => $this->id]);
        $this->id = null;
    }

    public function jsonSerialize()
    {
        return $this->mapPropertiesToDbFormat();
    }

//    private function refresh(): void
//    {
//        $objectFromDb = static::getById($this->id);
//        $reflector = new \ReflectionObject($objectFromDb);
//        $properties = $reflector->getProperties();
//
//        foreach ($properties as $property) {
//            $property->setAccessible(true);
//            $propertyName = $property->getName();
//            $this->$propertyName = $property->getValue($objectFromDb);
//        }
//    }

    protected function refresh(): void
    {
        $objectFromDb = static::getById($this->id);

        foreach ($objectFromDb as $property => $value) {
            $this->$property = $value;
        }

    }

    private function underscoreToCamelCase(string $source): string
    {
        return lcfirst(str_replace('_', '', ucwords($source, '_')));
    }

    private function camelCaseToUnderscore(string $source): string
    {
        return strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $source));
    }

    /**
     * @return static[]
     */
    public static function findAll(): array
    {
        $db = DB::getInstance();
        return $db->query('SELECT * FROM `' . static::getTableName() . '`;', [], static::class);
    }

    /**
     * @return static[]
     */
    public static function findAllOrder(string  $column): array
    {
        $db = DB::getInstance();
        return $db->query('SELECT * FROM `' . static::getTableName() . '` ORDER by `'. $column . '` DESC;', [], static::class);
    }

    /**
     * @return static[]
     */
    public static function findLimitAndOrder(int $limit, string  $column): array
    {
        $db = DB::getInstance();
        return $db->query('SELECT * FROM `' . static::getTableName() . '` ORDER by `'. $column . '` DESC LIMIT ' . $limit . ';', [], static::class);
    }

    public static function findByColumn(string $columnName, $value): ?array
    {
        $db = Db::getInstance();

        $result = $db->query(
          'SELECT * FROM `' . static::getTableName() . '` WHERE `' . $columnName . '` = :value;',
          [':value' => $value],
          static::class
        );

        if ($result === []) {
            return null;
        }

        return $result;
    }

    public static function findOneByColumn(string $columnName, $value): ?self
    {
        $db = Db::getInstance();

        $result = $db->query(
          'SELECT * FROM `' . static::getTableName() . '` WHERE `' . $columnName . '` = :value LIMIT 1;',
          [':value' => $value],
          static::class
        );

        if ($result === []) {
            return null;
        }

        return $result[0];
    }

    public static function search(string $query ,string $columnName): ?array
    {
        $db = Db::getInstance();

        $result = $db->query(
          "SELECT * FROM `" . static::getTableName() . "` WHERE `" . $columnName . "`  LIKE '%" . $query ."%'",
          [],
          static::class
        );

        if ($result === []) {
            return null;
        }

        return $result;
    }

    public static function getObjectByForeignKeys(string $table, string $joinTable, int $id, string $by = ''): array
    {
        if ($by === '') {
            $by = $joinTable;
            $sql = 'SELECT ' . $table .  '.* FROM `'. $table . '`
                            JOIN `' . $joinTable . '_' . $table . '` ON '. $joinTable . '_' . $table . '.' . $table . '_id = ' . $table . '.id
                            JOIN `' . $joinTable . '` ON ' . $joinTable . '_' . $table . '.' . $joinTable . '_id = ' . $joinTable . '.id
                            WHERE ' . $by . '.id = :id';
        } else {
            $sql = 'SELECT ' . $table .  '.* FROM `'. $table . '`
                            JOIN `' . $table . '_' . $joinTable . '` ON '. $table . '_' . $joinTable . '.' . $table . '_id = ' . $table . '.id
                            JOIN `' . $joinTable . '` ON ' . $table . '_' . $joinTable . '.' . $joinTable . '_id = ' . $joinTable . '.id
                            WHERE ' . $by . '.id = :id';
        }

        $db = DB::getInstance();
        return $db->query(
          $sql,
          [':id' => $id], static::class
        );
    }

    protected static function findBiggest(array $array, string $method): int
    {
        $biggest = $array[0];
        $biggestIndex = 0;

        for ($i = 1; $i < count($array); $i++) {
            if ($biggest->method() < $array[$i]->method()) {
                $biggest = $array[$i];
                $biggestIndex = $i;
            }
        }

        return $biggestIndex;
    }

    public static function selectionSortByColumn(array $array, string $method): array
    {
        $sortedArray = [];
        $sizeArray = count($array);

        for ($i = 0; $i < $sizeArray; $i++) {
            $biggestIndex = static::findBiggest($array, $method);
            $sortedArray[] = $array[$biggestIndex];
            array_splice($array, $biggestIndex, 1);
        }

        return $sortedArray;
    }

    /**
     * @param int $id
     * @return static|null
     */
    public static function getById(int $id): ?self
    {
        $db = DB::getInstance();
        $entities = $db->query(
          'SELECT * FROM `' . static::getTableName() . '` WHERE id=:id;',
          [':id' => $id],
          static::class
        );
        return $entities ? $entities[0] : null;
    }

    /**
     * @param string $name
     * @return static|null
     */
    public static function getByName(string $name): ?self
    {
        $db = DB::getInstance();
        $entities = $db->query(
          'SELECT * FROM `' . static::getTableName() . '` WHERE name=:name;',
          [':name' => $name],
          static::class
        );
        return $entities ? $entities[0] : null;
    }

    public static function getPagesCountFromDb(int $itemsPerPage): int
    {
        $db = Db::getInstance();
        $result = $db->query('SELECT COUNT(*) AS cnt FROM ' . static::getTableName() . ';');
        return ceil($result[0]->cnt / $itemsPerPage);
    }

    public static function getPagesCountFromArray(array $array, int $itemsPerPage): int
    {
        return ceil(count($array) / $itemsPerPage);
    }

    /**
     * @return static[]
     */
    public static function getPageFromDb(int $pageNum, int $itemsPerPage): array
    {
        $db = Db::getInstance();
        return $db->query(
          sprintf(
            'SELECT * FROM `%s` ORDER BY id DESC LIMIT %d OFFSET %d;',
            static::getTableName(),
            $itemsPerPage,
            ($pageNum - 1) * $itemsPerPage
          ),
          [],
          static::class
        );
    }

    /**
     * @return static[]
     */
    public static function getPageFromArray(array $array, int $pageNum, int $itemsPerPage): array
    {
        return array_slice($array, ($pageNum - 1) * $itemsPerPage, $itemsPerPage);
    }

    abstract protected static function getTableName(): string;
}