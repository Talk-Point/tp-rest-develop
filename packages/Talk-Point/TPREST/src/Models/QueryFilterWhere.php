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
        parent::__construct($key, $value, $cast_type);
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
                case 'startwith':
                    $this->operatorLike('LIKE', $start=false, $end=true);
                    break;
                case 'endwith':
                    $this->operatorLike('LIKE', $start=true, $end=false);
                    break;
                case 'like':
                    $this->operatorLike('LIKE', $start=true, $end=true);
                    break;
                case '!like':
                    $this->operatorLike('NOT LIKE', $start=true, $end=true);
                    break;
                default:
                    $this->operatorLike('LIKE', $start=true, $end=true);
            }
        }
    }

    /**
     * Create Operator Like with value start % and ends with %
     * @param $operator
     * @param bool $start add % to start
     * @param bool $end add % to end
     */
    private function operatorLike($operator, $start=true, $end=true)
    {
        $this->operator = $operator;
        if ($start === true) {
            $this->value = "%" . $this->value;
        }
        if ($end === true) {
            $this->value .= "%";
        }
    }

    /**
     * Run the Filter on the Query
     * @param $query
     * @return mixed
     */
    public function query($query)
    {
        $this->castValue();
        return $query->where($this->key, $this->operator, $this->value);
    }
}