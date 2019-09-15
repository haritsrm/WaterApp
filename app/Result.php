<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $fillable = [
        'name', 'pH', 'temperature', 'turbidity', 'classes'
    ];
}
