<?php

namespace TPREST\Models;

/**
 * Class QueryFilter
 * @package TPREST\Models
 */
class QueryFilter extends QueryModel
{
    /**
     * @param string $key sql table column
     * @param mixed $value value that filtered by
     * @param array $cast_array protected $cast Array from the Model Class
     * @return QueryFilterLike|QueryFilterWhere
     */
    public static function create($key, $value, $cast_array)
    {
        if (array_key_exists($key, $cast_array)) {
            if ($cast_array[$key] != 'string') {
                return new QueryFilterWhere($key, $value);
            }
        }
        return new QueryFilterLike($key, $value);
    }
}