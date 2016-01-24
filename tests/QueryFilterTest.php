<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\TestModel;
use TPREST\Http\RESTQuery;

class QueryFilterTest extends TestCase
{

    public function test_check_sql()
    {
        Input::replace($input = [
            'title' => 'Prof',
            'title2' => 'Prof;!',
            'number_double' => '3.14;<>',
            'number_float' => '1.5;<>',
            'number_integer' => '1;<>',
            'sortby' => 'id;desc',
            'limit' => 10,
            'offset' => 5
        ]);
        $sql = RESTQuery::create(TestModel::class)->query()->toSql();

        $this->assertContains('where `title` LIKE ?', $sql);
        $this->assertContains('`title2` != ?', $sql);
        $this->assertContains('`number_double` <> ?', $sql);
        $this->assertContains('order by `id` desc', $sql);
        $this->assertContains('limit 10', $sql);
        $this->assertContains('offset 5', $sql);
    }
}
