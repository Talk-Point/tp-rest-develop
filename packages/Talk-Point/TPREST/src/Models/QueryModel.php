<?php
/**
 * Created by PhpStorm.
 * User: konstantinstoldt
 * Date: 23/01/16
 * Time: 17:55
 */

namespace TPREST\Models;


abstract class QueryModel
{
    public function query($query)
    {
        return $query;
    }
}