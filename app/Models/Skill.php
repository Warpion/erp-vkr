<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $fillable = ['skill'];

    public function usersskill()
    {
        return $this->hasMany('App\Models\Usersskill');
    }
    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }
}
