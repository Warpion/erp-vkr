<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = ['user_id', 'title', 'urgency'];

    public function tasks()
    {
        return $this->hasMany('App\Models\Task')->orderBy('order');
    }


    //Переписать в Controller, а лучше в Репозитории!!!

    public function getTimeSum()
    {
        $tasksInfo = $this->tasks()
            ->select('time', 'time_avg', 'tasks_complete', 'tasks.order')
            ->join('categories','categories.id', '=', 'tasks.category_id')
            ->get();

        $project = array();

        foreach ($tasksInfo as $task){
            if($task->tasks_complete > 9){
                $task->time = $task->time_avg;
            }
            $project[$task->order][] = $task;
            if(isset($project[$task->order]['time'])) {
                if($project[$task->order]['time'] < $task->time)
                    $project[$task->order]['time'] = $task->time;
            }
            else{
                $project[$task->order]['time'] = 0;
                $project[$task->order]['time'] = $task->time;
            }
        }

        $totalTime = 0;

        foreach ($project as $item) {
            $totalTime += $item['time'];
        }
        //dd($project, $totalTime);
        return gmdate('H:i:s', $totalTime);
    }



}
