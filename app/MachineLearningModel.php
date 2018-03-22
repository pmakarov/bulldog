<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MachineLearningModel extends Model
{
    protected $hidden = ['pivot'];
    
    public function task()
    {
        $this->belongsToMany('App\Task');
    }
}
