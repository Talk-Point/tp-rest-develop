<?php
/**
 * Created by PhpStorm.
 * User: konstantinstoldt
 * Date: 23/01/16
 * Time: 17:55
 */

namespace TPREST\Models;


/**
 * Class QueryFilterWhere
 * @package TPREST\Models
 */
class QueryFilterWhere extends QueryFilter
{
    /**
     * @var string Operatroe ['=', '<', '>', '<=', '>=', '<>', '!=', 'like', 'not like', 'between']
     */
    protected $operator;

    /**
     * Return the Operator
     * @return string
     */
    public function getOperator()
    {
        return $this->operator;
    }

    /**
     * QueryFilterWhere constructor.
     * @param string $key sql table column
     * @param mixed $value value that filtered
     * @param string $cast_type Cast type: boolean, string, float, double
     */
    public function __construct($key, $value, $cast_type='string')
    {
        parent::__construct($key, $value);
        $this->chooseOperator($cast_type);
    }

    /**
     * Chose to the type a operator
     * @param $cast_type
     */
    protected function chooseOperator($cast_type)
    {
        if (count($this->options_array) == 0) {
            // Default value
            if ($cast_type == 'string') {
                $this->operator = 'LIKE';
                $this->value = "%" . $this->value . "%";
            } else {
                $this->operator = '=';
            }
        } else {
            switch($this->getNextOperator()) {
                case 'equal':
                case '=':
                    $this->operator = '=';
                    break;
                case '<':
                    $this->operator = '<';
                    break;
                case '>':
                    $this->operator = '>';
                    break;
                case '<=':
                    $this->operator = '<=';
                    break;
                case '>=':
                    $this->operator = '>=';
                    break;
                case '<>':
                    $this->operator = '<>';
                    break;
                case '!=':
                case '!':
                    $this->operator = '!=';
                    break;
                case 'like':
                    $this->operator = 'LIKE';
                    $this->value = "%" . $this->value . "%";
                    break;
                case 'startwith':
                    $this->operator = 'LIKE';
                    $this->value = $this->value . "%";
                    break;
                case 'endwith':
                    $this->operator = 'LIKE';
                    $this->value = "%" . $this->value;
                    break;
                case '!like':
                    $this->operator = 'NOT LIKE';
                    $this->value = "%" . $this->value . "%";
                    break;
                default:
                    $this->operator = 'LIKE';
                    $this->value = "%" . $this->value . "%";
            }
        }
    }

    /**
     * Run the Filter on the Query
     * @param $query
     * @return mixed
     */
    public function query($query)
    {
        return $query->where($this->key, $this->operator, $this->value);
    }
}