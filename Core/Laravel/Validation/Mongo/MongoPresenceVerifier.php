<?php

namespace Baileylo\Core\Laravel\Validation\Mongo;

use Illuminate\Validation\PresenceVerifierInterface;

class MongoPresenceVerifier implements PresenceVerifierInterface
{
    /** @var \MongoDB */
    private $db;

    public function __construct(\MongoDB $db)
    {
        $this->db = $db;
    }

    /**
     * Count the number of objects in a collection having the given value.
     *
     * @param  string $collection
     * @param  string $column
     * @param  string $value
     * @param  int    $excludeId
     * @param  string $idColumn
     * @param  array  $extra
     *
     * @return int
     */
    public function getCount($collection, $column, $value, $excludeId = null, $idColumn = null, array $extra = array())
    {
        $query = [$column => $value];

        if ($excludeId) {
            $idColumn = is_null($idColumn) ? '_id' : $idColumn;
            $excludeId = $this->isIdColumn($idColumn) ? $this->toMongoId($excludeId) : $excludeId;
            $query[$idColumn] = ['$ne' => $excludeId];
        }

        return $this->count($collection, $this->addExtras($query, $extra));
    }

    /**
     * Count the number of objects in a collection with the given values.
     *
     * @param  string $collection
     * @param  string $column
     * @param  array  $values
     * @param  array  $extra
     *
     * @return int
     */
    public function getMultiCount($collection, $column, array $values, array $extra = array())
    {
        if ($this->isIdColumn($column)) {
            $values = $this->toMongoIds($values);
        }

        return $this->count($collection, $this->addExtras([$column => $values], $extra));
    }

    private function count($collection, $query)
    {
        return $this->db->selectCollection($collection)->count($query);
    }

    private function addExtras(array $query, array $extras)
    {
        foreach($extras as $column => $value) {
            if ($this->isIdColumn($column)) {
                $value = $this->toMongoId($value);
            }

            $query[$column] = $value;
        }

        return $query;
    }

    private function isIdColumn($column)
    {
        return $column === '_id';
    }

    private function toMongoIds(array $values)
    {
        return array_map(function ($id) {
            return $this->toMongoId($id);
        }, $values);
    }

    private function toMongoId($value)
    {
        if ($value instanceof \MongoId) {
            return $value;
        }

        return new \MongoId($value);
    }
}
