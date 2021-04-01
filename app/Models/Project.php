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
            ->select('time', 'time_avg', 'tasks_complete', 'tasks.order',
                             'tasks.title', 'tasks.done_at', 'tasks.accept')
            ->join('categories','categories.id', '=', 'tasks.category_id')
            ->orderBy('tasks.order')
            ->get();

        $project = array();

        foreach ($tasksInfo as $key => $task){
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
        foreach ($project as $key => $item) {
            $totalTime += $item['time'];
        }
//        dd($project, $totalTime, $tasksInfo );
        return $totalTime;
    }

    public function getTasksChartInfo()
    {
        $tasksInfo = $this->tasks()
            ->select('tasks.id','time', 'time_avg', 'tasks_complete', 'tasks.order', 'tasks.title', 'tasks.description')
            ->join('categories','categories.id', '=', 'tasks.category_id')
            ->orderBy('tasks.order')
            ->get();


        $project = array();

        foreach ($tasksInfo as $key => $task){
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

        $tasks = array();
        $taskOrder = 0;
        $orderTime = 0;
        foreach ($project as $key => $item) {

            $futureTime = $item['time'];

            unset($item['time']);
            foreach ($item as $task) {
                $tasks[$taskOrder]['title'] = $task['title'];
                $tasks[$taskOrder]['description'] = $task['description'];
                $tasks[$taskOrder]['time'] = $task['time'];
                $tasks[$taskOrder]['id'] = $task['id'];
                $tasks[$taskOrder]['startTime'] = gmdate('H:i', $orderTime);
                $tasks[$taskOrder]['endTime'] = gmdate('H:i', $orderTime + $task['time']);
                $taskOrder++;
            }

            $orderTime += $futureTime;


        }

        return $tasks;
    }

}
