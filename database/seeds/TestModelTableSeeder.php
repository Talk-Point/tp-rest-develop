<?php

use Illuminate\Database\Seeder;

class TestModelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\TestModel::class, 50)->create();
    }
}
