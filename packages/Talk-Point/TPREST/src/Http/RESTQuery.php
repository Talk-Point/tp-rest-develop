<?php

namespace TPREST\Http;

use Illuminate\Support\Facades\Input;

class RESTQuery
{
    public static function create($query, $request)
    {
        $q = new RESTQuery($query, $request);

        return $q->getQuery();
    }

    public static function createForModel($request, $model_class, $method='limit', $default_limit=100)
    {
        if (!class_exists($model_class)) {
            throw new \Exception('RESTQuery Class not definied');
        }

        $limit = Input::get('limit', $default_limit);
        $query = call_user_func($model_class.'::'.$method, $limit);
        return RESTQuery::create($query, $request);
    }

    protected $query;
    protected $request;
    protected $keywords = ['sortby', 'descending', 'ascending', 'desc', 'asc', 'limit', 'offset'];

    public function __construct($query, $request)
    {
        // @todo add Validation
        $this->query = $query;
        $this->request = $request;
    }

    protected function parseFilter()
    {
        $parameter = array_except(Input::all(), $this->keywords);
        foreach($parameter as $key => $value) {
            $this->query->where($key, 'LIKE', '%'.$value.'%');
        }
    }

    public function getQuery()
    {
        $this->parseFilter();
        return $this->query->get();
    }
}