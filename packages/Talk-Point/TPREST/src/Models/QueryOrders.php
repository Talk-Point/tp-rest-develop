<?php
/**
 * Created by PhpStorm.
 * User: konstantinstoldt
 * Date: 23/01/16
 * Time: 17:55
 */

namespace TPREST\Models;


/**
 * Class QueryOrders
 * @package TPREST\Models
 */
class QueryOrders extends QueryModel
{
    /**
     * @param $key
     * @param $value
     * @return null|QueryOrderBy
     */
    public static function create($key, $value)
    {
        switch(strtolower($key)) {
            case 'sortby':
                return new QueryOrderBy($value);
                break;
            default:
                return null;
        }
    }
}