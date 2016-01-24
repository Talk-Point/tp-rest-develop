<?php
/**
 * Created by PhpStorm.
 * User: konstantinstoldt
 * Date: 23/01/16
 * Time: 17:55
 */

namespace TPREST\Models;


class QueryOrders extends QueryModel
{
    public static function create($key, $value)
    {
        switch(strtolower($key)) {
            case 'sortby':
                return new QueryOrderBy($value);
                break;
            case 'limit':
                return new QueryOrderLimit($value);
            case 'offset':
                return new QueryOrderOffset($value);
            default:
                return new QueryOrders();
        }
    }
}