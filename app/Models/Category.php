<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['title', 'price', 'time', 'time_avg', 'rating', 'max_rating', 'tasks_complete'];

    public function tasks()
    {
        return $this->hasMany('App\Models\Task');
    }

    public function setTimeAttribute($value)
    {
        $this->attributes['time'] = strtotime($value, 0);
    }
    public function setTimeAvgAttribute($value)
    {
        $this->attributes['time_avg'] = strtotime($value, 0);
    }

    public function getTimeAttribute($value)
    {
        return gmdate('H:i', $value);
    }

}
