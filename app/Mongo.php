<?php

namespace App;

use Jenssegers\Mongodb\Model as Eloquent;

class Mongo extends Eloquent
{
    protected $collection = 'mongos';
    protected $connection = 'mongodb';

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    public $casts = ['is_active' => 'boolean', 'number_double' => 'double', 'number_integer' => 'integer', 'number_float' => 'integer'];
}
