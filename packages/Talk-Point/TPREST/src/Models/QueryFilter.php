<?php

namespace TPREST\Models;

/**
 * Class QueryFilter
 * @package TPREST\Models
 */
class QueryFilter extends QueryModel
{
    /**
     * @param string $key sql table column
     * @param mixed $value value that filtered by
     * @param array $cast_array protected $cast Array from the Model Class
     * @return QueryFilterLike|QueryFilterWhere
     */
    public static function create($key, $value, $cast_array)
    {
        if (array_key_exists($key, $cast_array)) {
            return new QueryFilterWhere($key, $value, $cast_array[$key]);
        }
        return new QueryFilterWhere($key, $value, 'string');
    }

    /**
     * QueryFilter constructor.
     * @param string $key sql table column
     * @param mixed $value value that filtered
     */
    public function __construct($key, $value)
    {
        $this->key = $key;
        $this->value = $value;
        $this->extract_options();
    }

    /**
     * @var string sql table column
     */
    protected $key;
    /**
     * @var mixed filter by
     */
    protected $value;

    /**
     * @var array options after ;
     */
    protected $options_array;

    /**
     * Extract Options
     */
    protected function extract_options()
    {
        if (str_contains($this->value, ';')) {
            $this->options_array = explode(';', $this->value);
            $this->value = $this->options_array[0];
            array_shift($this->options_array);
            $arr = [];
            foreach($this->options_array as $e) {
                if (!(is_string($e) && $e=='')) {
                    array_push($arr, $e);
                }
            }
            $this->options_array = $arr;
        }
    }

    protected function getNextOperator()
    {
        return array_shift($this->options_array);
    }
}