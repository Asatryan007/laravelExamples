<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    //the fillable properties
    protected $fillable = [
        'title',
        'description',
        'startedAt',
        'completedAt',
        'deadline',
        'status',
    ];

}
