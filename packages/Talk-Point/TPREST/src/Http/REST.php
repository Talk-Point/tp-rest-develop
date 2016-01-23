<?php

namespace TPREST\Http;
use Illuminate\Support\Facades\Input;
use TPREST\Models\QueryModelManager;

/**
 * REST
 * @package TPREST\Http
 */
class REST
{
    /**
     * Konstruktor
     * @param $model_class
     * @return REST
     */
    public static function create($model_class)
    {
        $r = new REST($model_class);
        $r->attachParameterQuerys();
        return $r;
    }

    /**
     * @var string Class of Model
     */
    protected $model_class;
    /**
     * @var mixed Base Eloquent Model Query
     */
    protected $query;

    /**
     * REST constructor.
     * @param $model_class
     * @param int $default_limit
     */
    public function __construct($model_class, $default_limit=100)
    {
        $this->model_class = $model_class;
        $this->query = call_user_func($model_class.'::query');
    }

    /**
     * Add the generated Filter to the Query
     */
    protected function attachParameterQuerys()
    {
        $query_filter_array = QueryModelManager::create(Input::all(), $this->model_class);
        foreach($query_filter_array as $object) {
            $this->query = $object->query($this->query);
        }
    }

    /**
     * Return the Model Query
     * @return mixed
     */
    public function query()
    {
        return $this->query;
    }

}