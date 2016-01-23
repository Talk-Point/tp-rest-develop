<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use TPREST\Http\ModelParameter;
use TPREST\Http\FilterType;

class ModelParameterTest extends TestCase
{
    public function test_create_parameter_from_model()
    {
        // Mock
        //Input::replace($input = ['is_active' => true, 'title' => 'Test']);
    }

    public function test_empty_filter_parameter()
    {
        $m = new ModelParameter(\App\TestModel::class);
        $this->assertEquals([], $m->getFilterParameter());
    }

    public function test_get_filter_attributes()
    {
        Input::replace($input = ['sortby' => 'id', 'is_active' => true, 'title' => 'Test', 'number_integer' => 8, 'number_double' => 100.9]);

        $m = new ModelParameter(\App\TestModel::class);
        var_dump($m->getFilterParameter());
        $this->assertEquals([
            'is_active' => FilterType::BOOLEAN,
            'title' => FilterType::STRING,
            'number_integer' => FilterType::NUMERIC,
            'number_double' => FilterType::NUMERIC
        ], $m->getFilterParameter());
    }
}
