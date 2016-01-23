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

    protected $querys_objetcs = [];

    protected $model_class;
    protected $model_cast_array;

    /**
     * QueryModel constructor.
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
     * Return the Objects
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

    public function createFilterObjects($array)
    {
        foreach($array as $key => $value) {
            array_push($this->querys_objetcs, QueryFilter::create($key, $value, $this->model_cast_array));
        }
    }

    public function createOrderingObjects($array)
    {
        foreach($array as $key => $value) {
            array_push($this->querys_objetcs, QueryOrders::create($key, $value, ''));
        }
    }
}