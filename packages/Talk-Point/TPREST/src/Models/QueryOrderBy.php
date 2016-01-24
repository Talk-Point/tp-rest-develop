<?php

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
    protected $ordering;

    /**
     * QueryOrderBy constructor.
     * @param string $key sql table column
     * @param string $ordering ASC ord DESC
     */
    public function __construct($key, $ordering='ASC')
    {
        if (str_contains($key, ';')) {
            $key_array = explode(';', $key);
            $this->key = $key_array[0];
            $this->chooseOrdering($key_array[1]);
        } else {
            $this->key = $key;
            $this->ordering = $ordering;
        }
    }

    /**
     * Choose Ordering ASC or DESC
     * @param string $order_key OrderKey
     * @return string
     */
    public function chooseOrdering($order_key)
    {
        switch(strtolower($order_key)) {
            case 'ascending':
            case 'asc':
                return OrderingInterface::ASC;
            case 'descending':
            case 'desc':
                return OrderingInterface::DESC;
            default:
                return OrderingInterface::ASC;
        }
    }

    /**
     * Run the Filter on the Query
     * @param $query
     * @return mixed
     */
    public function query($query)
    {
        return $query->orderBy($this->key, $this->ordering);
    }
}