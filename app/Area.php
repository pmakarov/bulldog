<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Phaza\LaravelPostgis\Eloquent\PostgisTrait;

class Area extends Model
{
    use PostgisTrait;

    protected $hidden = ['pivot'];
    
    protected $fillable = [
        'name',
    ];
    protected $postgisFields = [
        'polygon'
    ];
    
    protected $postgisTypes = [
        'polygon' => [
            'geomtype' => 'geometry',
            'srid' => 4326
        ]
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function task()
    {
        return $this->belongsToMany('App\Task');
    }
}
