<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\TestModel;
use TPREST\Http\RESTQuery;
use TPREST\Models\QueryFilter;
Use TPREST\Models\QueryFilterLike;
use TPREST\Models\QueryFilterWhere;

class QueryFilterWhereModelTest extends TestCase
{
    public function test_filter_operator_equal()
    {
        $filter = QueryFilter::create(
            'title',
            'prof',
            ['is_active' => 'boolean', 'number_double' => 'double', 'number_integer' => 'integer']
        );

        $this->assertTrue($filter instanceof QueryFilterWhere);
    }

    public function test_operator()
    {
        $this->assertEquals('LIKE', QueryFilter::create('title', 'prof', [])->getOperator());
        $this->assertEquals('=', QueryFilter::create('title', 'prof;equal', [])->getOperator());
        $this->assertEquals('=', QueryFilter::create('title', 'prof;=', [])->getOperator());
        $this->assertEquals('<', QueryFilter::create('title', 'prof;<', [])->getOperator());
        $this->assertEquals('>', QueryFilter::create('title', 'prof;>', [])->getOperator());
        $this->assertEquals('>=', QueryFilter::create('title', 'prof;>=', [])->getOperator());
        $this->assertEquals('<=', QueryFilter::create('title', 'prof;<=', [])->getOperator());
        $this->assertEquals('<>', QueryFilter::create('title', 'prof;<>', [])->getOperator());
        $this->assertEquals('!=', QueryFilter::create('title', 'prof;!', [])->getOperator());
        $this->assertEquals('!=', QueryFilter::create('title', 'prof;!=', [])->getOperator());
        $this->assertEquals('LIKE', QueryFilter::create('title', 'prof;like', [])->getOperator());
        $this->assertEquals('LIKE', QueryFilter::create('title', 'prof;startwith', [])->getOperator());
        $this->assertEquals('LIKE', QueryFilter::create('title', 'prof;endwith', [])->getOperator());
        $this->assertEquals('NOT LIKE', QueryFilter::create('title', 'prof;!like', [])->getOperator());
    }

    public function test_operator_not_exists()
    {
        $this->assertEquals('LIKE', QueryFilter::create('title', 'prof;osihrg', [])->getOperator());
        $this->assertEquals('LIKE', QueryFilter::create('title', 'prof;', [])->getOperator());
        $this->assertEquals('LIKE', QueryFilter::create('title', 'prof;!!', [])->getOperator());
    }
}
