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
     * @return QueryFilterWhere
     */
    public static function create($key, $value, $cast_array)
    {
        if (array_key_exists($key, $cast_array)) {
            return new QueryFilterWhere($key, $value, $cast_array[ $key ]);
        }
        return new QueryFilterWhere($key, $value, 'string');
    }

    /**
     * QueryFilter constructor.
     * @param string $key sql table column
     * @param mixed $value value that filtered
     * @param string $cast_type Type of element
     */
    public function __construct($key, $value, $cast_type = 'string')
    {
        $this->key = $key;
        $this->value = $value;
        $this->cast_type = $cast_type;
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
     * @var string cast type
     */
    protected $cast_type;

    /**
     * Extract Options
     */
    protected function extract_options()
    {
        if (str_contains($this->value, ';')) {
            $this->options_array = explode(';', $this->value);
            $this->value = $this->options_array[0];
            array_shift($this->options_array);
            $this->remove_empty_options();
        }
    }

    /**
     * Remove Empty Values from Option Array
     */
    protected function remove_empty_options()
    {
        $arr = [];
        foreach($this->options_array as $e) {
            if (!(is_string($e) && $e=='')) {
                array_push($arr, $e);
            }
        }
        $this->options_array = $arr;
    }

    /**
     * Return the next operator
     * @return mixed
     */
    protected function getNextOperator()
    {
        return array_shift($this->options_array);
    }

    /**
     * Cast the Value for the query by the cast array
     */
    protected function castValue()
    {
        switch ($this->cast_type) {
            case 'float':
                $this->value = floatval($this->value);
                break;
            case 'double':
                $this->value = doubleval($this->value);
                break;
            case 'integer':
                $this->value = intval($this->value);
                break;
            case 'array':
                break;
            default:
                $this->value = strval($this->value);
        }
    }
}