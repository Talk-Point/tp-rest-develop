<?php

namespace TPREST\Models;

/**
 * Class QueryOrderLimit
 * @package TPREST\Models
 */
class QueryOrderLimit extends QueryModel
{
    /**
     * @var int limit
     */
    protected $limit;

    /**
     * QueryOrderBy constructor.
     * @param int $limit Limit
     */
    public function __construct($limit=100)
    {
        $this->limit = $limit;
    }

    /**
     * Run the Filter on the Query
     * @param $query
     * @return mixed
     */
    public function query($query)
    {
        if ($this->limit > 0) {
            return $query->limit(intval($this->limit));
        }
        return $query;
    }
}