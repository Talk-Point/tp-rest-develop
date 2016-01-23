<?php

namespace TPREST\Http;

use App\TestModel;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;

/**
 * Class RESTQuery
 *
 * Create attributes to the Model Query
 *
 * @package TPREST\Http
 */
class RESTQuery
{
    /**
     * Konstruktor to create a Query
     * @param $query
     * @param Request $request
     * @param string $model_class Class String of Model
     * @return mixed
     */
    public static function create($query, $request, $model_class)
    {
        $q = new RESTQuery($query, $request, $model_class);

        return $q->query();
    }

    /**
     * Kontruktor to create a Model Query
     * @param $request
     * @param $model_class
     * @param string $method
     * @param int $default_limit
     * @return mixed
     * @throws \Exception
     */
    public static function createForModel($request, $model_class, $method='query', $default_limit=100)
    {
        if (!class_exists($model_class)) {
            throw new \Exception('RESTQuery Class not definied');
        }

        $limit = Input::get('limit', $default_limit);
        $query = call_user_func($model_class.'::'.$method, $limit);
        return RESTQuery::create($query, $request, $model_class);
    }

    /**
     * @var
     */
    protected $query;

    /**
     * @var Request
     */
    protected $request;

    /**
     * @var string Model Class Name
     */
    protected $class_name;

    /**
     * @var ModelParameter
     */
    protected $model_parameter;

    /**
     * RESTQuery constructor.
     * @param $query
     * @param Request $request
     */
    public function __construct($query, $request, $class_name)
    {
        // @todo add Validation
        $this->query = $query;
        $this->request = $request;
        $this->class_name = $class_name;

        $this->model_parameter = ModelParameter::create($this->class_name);
    }

    /**
     * Rturn the generated Query for the Model
     * @return mixed
     */
    public function query()
    {
        $this->filterQuery();
        return $this->query;
    }

    /**
     * At filter to the model
     */
    private function filterQuery()
    {
        foreach($this->model_parameter->getFilterParameter() as $key => $search_type) {
            switch($search_type) {
                case FilterType::STRING:
                    $this->query->where($key, 'LIKE', '%'.Input::get($key, '').'%');
                    break;
                default:
                    $this->query->where($key, Input::get($key));
            }
        }
    }
}