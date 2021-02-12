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
        $tasksInfo = $this->tasks()
            ->select('time', 'time_avg', 'tasks_complete')
            ->join('categories','categories.id', '=', 'tasks.category_id')
            ->get();
        $totalTime = 0;
        foreach ($tasksInfo as $item) {
            if($item->tasks_complete > 9){
                $totalTime += $item->time_avg;
            }
            else {
                $totalTime += $item->time;
            }
        }
        return gmdate('H:i:s', $totalTime);
    }
}
