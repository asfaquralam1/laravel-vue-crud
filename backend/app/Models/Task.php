<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use SoftDeletes;

    protected $table = 'tasks';

    protected $dates = ['deleted_at'];

     protected $fillable = [
        'title',
        'description',
    ];

    protected $casts = [
        'title' => 'string',
        'description' => 'string',
    ];
}
