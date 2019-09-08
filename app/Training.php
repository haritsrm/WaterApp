<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    protected $fillable = [
        'name', 'pH', 'temperature', 'turbidity', 'classes'
    ];
}
