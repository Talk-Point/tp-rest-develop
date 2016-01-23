<?php
/**
 * Created by PhpStorm.
 * User: konstantinstoldt
 * Date: 23/01/16
 * Time: 17:55
 */

namespace TPREST\Models;


use TPREST\Http\FilterType;

class QueryFilter extends QueryModel
{
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