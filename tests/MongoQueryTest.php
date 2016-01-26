<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MongoQueryTest extends TestCase
{
    public function test_mongo_see_items()
    {
        $object = \App\Mongo::first();

        $this->visit('/mongo')
             ->see($object->title);

        $this->visit('/mongo?title='.$object->title.';!')
            ->dontSee($object->title);
    }
}
