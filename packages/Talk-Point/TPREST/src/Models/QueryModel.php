<?php
/**
 * Created by PhpStorm.
 * User: konstantinstoldt
 * Date: 23/01/16
 * Time: 17:55
 */

namespace TPREST\Models;


/**
 * Class QueryModel
 *
 * Add a filter on the Query
 *
 * @package TPREST\Models
 */
abstract class QueryModel
{
    /**
     * Run the Filter on the Query
     * @param $query
     * @return mixed
     */
    public function query($query)
    {
        return $query;
    }
}