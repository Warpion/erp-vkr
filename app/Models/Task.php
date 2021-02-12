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
        'started_at', 'done_at', 'accept'
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
//        dd($this::query()->whereNull('user_id')
//            ->join('categories','categories.id', '=', 'tasks.category_id')
//            ->whereBetween('rating', [$userRating - 200, $userRating + 200])
//            ->orWhere('tasks.created_at', '<', Carbon::now()->subHours(1)->toDateTimeString() )
//            ->whereNull('user_id')
//            ->get()
//        , Carbon::now()->subHours(1)->toDateTimeString(), Carbon::now()->toDateTimeString());
        return $this::query()->whereNull('user_id')
            ->join('categories','categories.id', '=', 'tasks.category_id')
            ->whereBetween('rating', [$userRating - 200, $userRating + 200])
            ->orWhere('tasks.created_at', '<', Carbon::now()->subHours(1)->toDateTimeString() )
            ->whereNull('user_id')
            ->get();
    }
}
