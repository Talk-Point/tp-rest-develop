<?php
/**
 * Created by PhpStorm.
 * User: konstantinstoldt
 * Date: 23/01/16
 * Time: 17:55
 */

namespace TPREST\Models;


class QueryOrderBy extends QueryModel
{
    protected $key;
    protected $order;

    public function __construct($key, $order='DESC')
    {
        $this->key = $key;
        $this->order = $order;
    }

    public function query($query)
    {
        return $query->orderBy($this->key, $this->order);
    }
}