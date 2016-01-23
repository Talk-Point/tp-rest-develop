<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\TestModel;
use TPREST\Http\RESTQuery;

class RESTQueryFilterTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function test_filter_string()
    {
        $count = TestModel::all()->count();

        $count_1 = TestModel::where('title', 'LIKE', '%PROF%')->count();
        Input::replace($input = ['title' => 'prof']);
        $count_2 = RESTQuery::createForModel(new \Illuminate\Support\Facades\Request(), TestModel::class)->count();

        $this->assertNotEquals($count, $count_1, 'Der Test kann nicht funkunieren, sseede bitte neu! ');
        $this->assertEquals($count_1, $count_2);
    }

    public function test_filter_numeric()
    {
        $model = TestModel::first();

        $count_1 = TestModel::where('number_double', $model->number_float)->count();
        Input::replace($input = ['number_double' => $model->number_float]);
        $count_2 = RESTQuery::createForModel(new \Illuminate\Support\Facades\Request(), TestModel::class)->count();

        $this->assertEquals($count_1, $count_2);
    }

    public function test_filter_boolean()
    {
        $count = TestModel::all()->count();

        $count_1 = TestModel::where('is_active', true)->count();
        Input::replace($input = ['is_active' => true]);
        $count_2 = RESTQuery::createForModel(new \Illuminate\Support\Facades\Request(), TestModel::class)->count();

        $this->assertNotEquals($count, $count_1, 'Der Test kann nicht funkunieren, sseede bitte neu! ');
        $this->assertEquals($count_1, $count_2);
    }

    public function test_filter_attribute_not_exists_in_model()
    {
        $throw = false;
        try {
            Input::replace($input = ['not_exists_attribute' => true]);
            $count_2 = RESTQuery::createForModel(new \Illuminate\Support\Facades\Request(), TestModel::class)->count();
        } catch (Exception $e) {
            $throw = true;
        }
        $this->assertTrue($throw, 'Exception wurde nicht gefeuert');
    }
}
