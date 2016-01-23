<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TestModel extends Model
{
    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = ['is_active' => 'boolean',];
}
