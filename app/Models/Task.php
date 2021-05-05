<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Task extends Model
{
    protected $fillable = [
        'title', 'description', 'category_id',
        'project_id', 'user_id', 'order',
        'started_at', 'done_at', 'accept',
        'profit',
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
        $userRating = Auth::user()->rating;

        $tasks = $this::query()
            ->select('categories.rating', 'categories.price',
                'tasks.created_at', 'categories.max_rating', 'tasks.title', 'tasks.user_id', 'tasks.id', 'tasks.description',
                'projects.urgency')
            ->join('categories','categories.id', '=', 'tasks.category_id')
            ->join('projects', 'projects.id', '=', 'tasks.project_id')


            ->whereBetween('rating', [$userRating - 200, $userRating + 200])
            ->where('max_rating', '>', $userRating)
            ->whereNull('tasks.user_id')

            ->orWhere('tasks.created_at', '<', Carbon::now()->subHours(1)->toDateTimeString() )
            ->where('max_rating', '>', $userRating)
            ->whereNull('tasks.user_id')

            ->orWhere('tasks.created_at', '<', Carbon::now()->subHours(1)->toDateTimeString() )
            ->where('max_rating', '=', 0)
            ->whereNull('tasks.user_id')

            ->orderBy('projects.urgency')
            ->get();

        foreach ($tasks as $key => $task) {
            $tasks[$key]['setPrice'] = setTaskPrice($task->rating, $task->price, $userRating, $task->urgency);
        }

        return $tasks;
    }
}
