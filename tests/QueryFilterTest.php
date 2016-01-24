<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\TestModel;
use TPREST\Http\RESTQuery;

class QueryFilterTest extends TestCase
{
    public function test_filter_query()
    {
        $count = \App\TestModel::all()->count();

        $count_where = \App\TestModel::where('title', 'LIKE', '%PROF%')->count();
        Input::replace($input = ['title' => 'Prof']);
        $count_query = RESTQuery::create(TestModel::class)->query()->count();

        $this->assertNotEquals($count, $count_where, 'RISKY test');
        $this->assertEquals($count_where, $count_query, 'Query is not the same where search');


        /*Input::replace($input = ['title' => 'Prof']);
        Input::replace($input = ['number_double' => $model->number_float]);
        Input::replace($input = ['number_double' => $model->number_float]);
        Input::replace($input = ['is_active' => true]);
        Input::replace($input = ['not_exists_attribute' => true]);*/
    }
}
