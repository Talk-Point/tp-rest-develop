<?php

namespace TPREST\Models;

/**
 * Class QueryOrderOffset
 * @package TPREST\Models
 */
class QueryOrderOffset extends QueryModel
{
    /**
     * @var int offset
     */
    protected $offset;

    /**
     * QueryOrderBy constructor.
     * @param int $limit Limit
     */
    public function __construct($offset=0)
    {
        $this->offset = $offset;
    }

    /**
     * Run the Filter on the Query
     * @param $query
     * @return mixed
     */
    public function query($query)
    {
        if ($this->offset >= 1) {
            return $query->skip(intval($this->offset));
        }
        return $query;
    }
}