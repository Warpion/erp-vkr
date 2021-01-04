<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'title', 'description', 'category_id',
        'project_id', 'user_id', 'order',
        'started_at', 'done_at',
    ];

    public function project()
    {
        return $this->belongsTo('App\Models\Project');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function getTasks()
    {
        return $this::whereNull('user_id')->get();
    }
}
