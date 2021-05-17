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
        $userSkills = Auth::user()->skills;
        $skillId = array();
        $skills = array();
        if(isset($userSkills)) {
            foreach($userSkills as $skill) {
                $skillId[] = $skill->skill_id;
                $skills[$skill->skill_id] = $skill->rating;
            }
        }
        $tasks= array();
            $tasks = $this::query()->select('categories.rating', 'categories.price', 'categories.skill_id',
                'tasks.created_at', 'categories.max_rating', 'tasks.title', 'tasks.user_id', 'tasks.id', 'tasks.description',
                'projects.urgency')
                ->join('categories','categories.id', '=', 'tasks.category_id')
                ->join('skills','skills.id', '=', 'categories.id')
                ->join('projects', 'projects.id', '=', 'tasks.project_id')

                ->whereNull('tasks.user_id')
                ->where('categories.skill_id', '=', null)

                ->orWhereNull('tasks.user_id')
                ->whereIn('categories.skill_id', $skillId)

                ->orWhereNull('tasks.user_id')
                ->whereNotIn('categories.skill_id', $skillId)
                ->where('categories.max_rating', '=', 0)

                ->get();

//        dd($userRating->where('skill_id', '=', 31)->first()->rating);
/*
        $tasks = $this::query()
            ->select('categories.rating', 'categories.price', 'categories.skill_id',
                'tasks.created_at', 'categories.max_rating', 'tasks.title', 'tasks.user_id', 'tasks.id', 'tasks.description',
                'projects.urgency')
            ->join('categories','categories.id', '=', 'tasks.category_id')
            ->join('skills','skills.id', '=', 'categories.id')
            ->join('projects', 'projects.id', '=', 'tasks.project_id')


            ->whereBetween('categories.rating', [$userRating - 200, $userRating + 200])
            ->where('categories.max_rating', '>', $userRating)
            ->whereNull('tasks.user_id')

            ->orWhere('tasks.created_at', '<', Carbon::now()->subHours(1)->toDateTimeString() )
            ->where('categories.max_rating', '>', $userRating)
            ->whereNull('tasks.user_id')

            ->orWhere('tasks.created_at', '<', Carbon::now()->subHours(1)->toDateTimeString() )
            ->where('categories.max_rating', '=', 0)
            ->whereNull('tasks.user_id')

            ->orderBy('projects.urgency')
            ->get();
*/

//        dd($tasks, $skills);

        foreach ($tasks as $key => $task) {
            if( isset($skills[$task->skill_id]) ) {
                $skillRating = $skills[$task->skill_id];
            } else {
                $skillRating = 0;
            }
            if( !( ($task->rating - 200) < $skillRating && ($task->rating + 200) > $skillRating)
              && ( strtotime($task->created_at) > time()-3600) ) {
                unset($tasks[$key]);
                continue;
            }
            if( !( ($task->rating - 400) < $skillRating && ($task->rating + 400) > $skillRating)
                && ( strtotime($task->created_at) < time()-3600) ) {
                unset($tasks[$key]);
                continue;
            }
            $tasks[$key]['setPrice'] = setTaskPrice($task->rating, $task->price, $skillRating, $task->urgency);
        }

        return $tasks;
    }
}
