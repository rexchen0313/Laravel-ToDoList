<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todolist extends Model
{
    protected $table = 'todolist';
    
    protected $fillable = [
        'title', 'content'
    ];

    protected $hidden = [];
}
