<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['user_id', 'title'];

    public function tasks()
    {
        return $this->hasMany('App\Models\Task')->orderBy('order');
    }

    public function getTimeSum()
    {
        return gmdate('H:i:s', $this->tasks()
            ->join('categories','categories.id', '=', 'tasks.category_id')
            ->sum('time'));
    }
}
