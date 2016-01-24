<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\TestModel;
use TPREST\Http\RESTQuery;

class QueryOrdersTest extends TestCase
{
    public function test_order_default()
    {
        Input::replace($input = [
            'sortby' => 'id',
        ]);
        $sql = RESTQuery::create(TestModel::class)->query()->toSql();

        $this->assertContains('order by `id` asc', $sql);
    }

    public function test_order_by_asc()
    {
        Input::replace($input = [
            'sortby' => 'id;asc',
        ]);
        $sql = RESTQuery::create(TestModel::class)->query()->toSql();

        $this->assertContains('order by `id` asc', $sql);
    }

    public function test_order_by_desc()
    {
        Input::replace($input = [
            'sortby' => 'id;desc',
        ]);
        $sql = RESTQuery::create(TestModel::class)->query()->toSql();

        $this->assertContains('order by `id` desc', $sql);
    }
}
