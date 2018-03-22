<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $hidden = ['pivot'];
    
    protected $guarded = ['id', 'user_id'];
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function geometries()
    {
        return $this->belongsToMany('App\Area');
    }

    public function machine_learning_models()
    {
        return $this->belongsToMany('App\MachineLearningModel');
    }
}
