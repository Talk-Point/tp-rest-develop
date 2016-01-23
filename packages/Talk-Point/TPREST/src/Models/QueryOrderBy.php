<?php
/**
 * Created by PhpStorm.
 * User: konstantinstoldt
 * Date: 23/01/16
 * Time: 17:55
 */

namespace TPREST\Models;


/**
 * Class QueryOrderBy
 * @package TPREST\Models
 */
class QueryOrderBy extends QueryModel
{
    /**
     * @var
     */
    protected $key;
    /**
     * @var string
     */
    protected $order;

    /**
     * QueryOrderBy constructor.
     * @param string $key sql table column
     * @param string $order ASC ord DESC
     */
    public function __construct($key, $order='DESC')
    {
        $this->key = $key;
        $this->order = $order;
    }

    /**
     * Run the Filter on the Query
     * @param $query
     * @return mixed
     */
    public function query($query)
    {
        return $query->orderBy($this->key, $this->order);
    }
}