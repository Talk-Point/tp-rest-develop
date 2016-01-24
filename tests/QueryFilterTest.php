<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\TestModel;
use TPREST\Http\RESTQuery;

class QueryFilterTest extends TestCase
{
    /*
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
    }*/

    public function test_check_sql()
    {
        Input::replace($input = [
            'title' => 'Prof',
            'title2' => 'Prof;!',
            'number_double' => '3.14;<>',
            'number_float' => '1.5;<>',
            'number_integer' => '1;<>',
            'sortby' => 'id;desc',
        ]);
        $sql = RESTQuery::create(TestModel::class)->query()->toSql();

        $this->assertContains('where `title` LIKE ?', $sql);
        $this->assertContains('`title2` != ?', $sql);
        $this->assertContains('`number_double` <> ?', $sql);
        $this->assertContains('order by `id` desc', $sql);
    }
}
