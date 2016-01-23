<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RESTQueryFilterTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function test_filter_string()
    {
        $this->visit('/tests')
             ->see('Laravel 5');
    }
}
