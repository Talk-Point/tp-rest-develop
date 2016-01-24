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
     * @var int offset
     */
    protected $offset;

    /**
     * QueryOrderBy constructor.
     * @param int $limit Limit
     * @param int $offset Offset parameter
     */
    public function __construct($limit=100, $offset=0)
    {
        $this->limit = $limit;
        $this->offset = $offset;
    }

    /**
     * Run the Filter on the Query
     * @param $query
     * @return mixed
     */
    public function query($query)
    {
        if ($this->limit > 0) {
            $query = $query->limit(intval($this->limit));
        }
        if ($this->offset != 0) {
            $query = $query->skip(intval($this->offset));
        }
        return $query;
    }
}