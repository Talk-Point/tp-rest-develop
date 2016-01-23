<?php

namespace TPREST\Models;

use ReflectionClass;
use ReflectionProperty;

/**
 * Abstract Factory
 * @package TPREST\Models
 */
class QueryModelManager
{
    /**
     * Create Factory
     * @param array $parameter_array Array with GET Parameter
     * @param string $model_class Model Class
     * @return array of Filter Objects
     */
    public static function create($parameter_array, $model_class)
    {
        $manager = new QueryModelManager($parameter_array, $model_class);
        return $manager->getQuerysObjetcs();
    }

    /**
     * Protected Keywords thats not a filter
     * @var array
     */
    protected $keywords = ['sortby', 'descending', 'ascending', 'desc', 'asc', 'limit', 'offset'];

    /**
     * Objects tahts filtered By
     * @var array
     */
    protected $querys_objetcs = [];

    /**
     * @var string Model Class
     */
    protected $model_class;
    /**
     * @var array proteced $cast array from Model
     */
    protected $model_cast_array;

    /**
     * QueryModel constructor.
     * @param array $parameter_array Array with GET Parameter
     * @param string $model_class Model Class
     */
    public function __construct($parameter_array, $model_class)
    {
        $this->model_class = $model_class;
        $this->model_cast_array = $this->getCastsArrayFromModel();

        $parameter_filter = array_except($parameter_array, $this->keywords);

        $this->createFilterObjects($parameter_filter);
        $this->createOrderingObjects($parameter_array);
    }

    /**
     * Getter Query Objects
     * @return array
     */
    public function getQuerysObjetcs()
    {
        return $this->querys_objetcs;
    }

    /**
     * Return the protected $casts Array from the Model Class
     * @return mixed|null
     */
    protected function getCastsArrayFromModel()
    {
        $reflect = new ReflectionClass($this->model_class);
        $props = $reflect->getProperties(ReflectionProperty::IS_PUBLIC | ReflectionProperty::IS_PROTECTED);
        foreach($props as $prop) {
            if ($prop->getName() == 'casts') {
                return $reflect->getProperty('casts')->getValue(new $this->model_class());
            }
        }
        return null;
    }

    /**
     * Create Filter
     * @param $array
     */
    protected function createFilterObjects($array)
    {
        foreach($array as $key => $value) {
            $object = QueryFilter::create($key, $value, $this->model_cast_array);
            if (!is_null($object)) {
                array_push($this->querys_objetcs, $object);
            }
        }
    }

    /**
     * Create Other Filter
     * @param $array
     */
    protected function createOrderingObjects($array)
    {
        foreach($array as $key => $value) {
            $object = QueryOrders::create($key, $value, '');
            if (!is_null($object)) {
                array_push($this->querys_objetcs, $object);
            }
        }
    }
}