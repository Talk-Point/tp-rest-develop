<?php
/**
 * Created by PhpStorm.
 * User: konstantinstoldt
 * Date: 23/01/16
 * Time: 17:55
 */

namespace TPREST\Models;


/**
 * Query Like Filter
 * @package TPREST\Models
 */
class QueryFilterLike extends QueryFilter
{
    /**
     * @var string sql table column
     */
    protected $key;
    /**
     * @var mixed
     */
    protected $value;

    /**
     * QueryFilterLike constructor.
     * @param string $key sql table column
     * @param mixed $value
     */
    public function __construct($key, $value)
    {
        $this->key = $key;
        $this->value = $value;
    }

    /**
     * Run the Filter on the Query
     * @param $query
     * @return mixed
     */
    public function query($query)
    {
        return $query->where($this->key, 'LIKE', '%'.$this->value.'%');
    }
}