<?php
/**
 * Created by PhpStorm.
 * User: konstantinstoldt
 * Date: 23/01/16
 * Time: 17:55
 */

namespace TPREST\Models;


class QueryFilter extends QueryModel
{
    public static function create($key, $value, $cast_array)
    {
        return new QueryFilterLike($key, $value);
    }
}