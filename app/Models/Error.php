<?php

 namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Error extends Eloquent
{

    protected $fillable = ['name'];
    
    public $timestamps = false;

    public function logs()
    {
        return $this->hasMany('App\Models\Log', 'error_id', 'id');
    }
}
