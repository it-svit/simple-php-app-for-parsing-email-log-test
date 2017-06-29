<?php

 namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Log extends Eloquent
{

    protected $fillable = ['error_id', 'to', 'ctladdr' ];
    
    public $timestamps = false;
}
