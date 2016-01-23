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
    public static function create($model_class)
    {
        $r = new REST($model_class);
        $r->parseParameter();
        return $r;
    }

    protected $model_class;
    protected $query;

    protected $query_filter_array;

    public function __construct($model_class, $default_limit=100)
    {
        $this->model_class = $model_class;
        $this->query = call_user_func($model_class.'::query');
    }

    protected function parseParameter()
    {
        $query_filter_array = QueryModelManager::create(Input::all(), $this->model_class);
        foreach($query_filter_array as $object) {
            $this->query = $object->query($this->query);
        }
    }

    public function query()
    {
        return $this->query;
    }

}