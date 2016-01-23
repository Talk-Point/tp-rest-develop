<?php
/**
 * Created by PhpStorm.
 * User: konstantinstoldt
 * Date: 23/01/16
 * Time: 15:55
 */

namespace TPREST\Http;


use Illuminate\Support\Facades\Input;
use ReflectionClass;
use ReflectionProperty;

/**
 * ModelParameter with Type
 *
 * Create from the Input:: the parameter with search type to create easy Eloquent Querys
 *
 * @package TPREST\Http
 */
class ModelParameter
{
    /**
     * Konstruktor
     * @param string $model_class Model Class Name
     * @return ModelParameter
     */
    public static function create($model_class)
    {
        $m = new ModelParameter($model_class);
        return $m;
    }

    /**
     * @var string Method Class
     */
    protected $class;

    /**
     * ModelParameter constructor.
     * @param $model_class
     */
    public function __construct($model_class)
    {
        $this->class = $model_class;
    }

    protected $keyword_sort = ['sortby', 'descending', 'ascending', 'desc', 'asc', 'limit', 'offset'];

    /**
     * Return the protected $casts Array from the Model Class
     * @return mixed|null
     */
    protected function getCastsArrayFromModel()
    {
        $reflect = new ReflectionClass($this->class);
        $props = $reflect->getProperties(ReflectionProperty::IS_PUBLIC | ReflectionProperty::IS_PROTECTED);
        foreach($props as $prop) {
            if ($prop->getName() == 'casts') {
                return $reflect->getProperty('casts')->getValue(new $this->class());
            }
        }
        return null;
    }

    /**
     *  Return a Filter Search Array
     */
    public function getFilterParameter()
    {
        $parameter = array_except(Input::all(), $this->keyword_sort);
        if (count($parameter) == 0) {
            return [];
        }

        $a = [];
        $casts = $this->getCastsArrayFromModel();
        $parameter = array_except(Input::all(), $this->keyword_sort);
        foreach($parameter as $p => $value) {
            if (array_key_exists($p, $casts)) {
                switch($casts[$p]) {
                    case 'boolean':
                        $a[$p] = FilterType::BOOLEAN;
                        break;
                    case 'double':
                    case 'float':
                    case 'integer':
                        $a[$p] = FilterType::NUMERIC;
                        break;
                    default:
                        $a[$p] = FilterType::STRING;
                        break;
                }
            } else {
                $a[$p] = FilterType::STRING;
            }
        }

        return $a;
    }
}