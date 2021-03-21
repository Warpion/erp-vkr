<?php

namespace App\Observers;

use App\Models\Category;
use App\Models\Task;
use App\Models\User;

class TaskObserver
{
    /**
     * Handle the task "created" event.
     *
     * @param  \App\Models\Task  $task
     * @return void
     */
    public function created(Task $task)
    {
        //
    }

    /**
     * Handle the task "updated" event.
     *
     * @param  \App\Models\Task  $task
     * @return void
     */
    public function updated(Task $task)
    {
        if($task->accept === 1) {
            $timeAvg = $task->category->time_avg;
            $taskDuration = strtotime($task->done_at, 0) - strtotime($task->started_at, 0);

            $tasksDone = $task->category->tasks_complete;
            $category = Category::query()->find($task->category_id);
            $newTime = gmdate('H:i', ceil(($timeAvg * $tasksDone + $taskDuration) / ($tasksDone + 1)) );
            $tasksDone++;
            $category->update(['tasks_complete' => $tasksDone, 'time_avg' => $newTime]);

            $user = User::query()->find($task->user_id);
            $newRating = setTaskPrice($category->rating, $category->price, $user->rating);
            $user->update(['rating' => $newRating]);
        }
        if($task->accept === 0) {
            $user = User::query()->find($task->user_id);
            $category = Category::query()->find($task->category_id);
            $newRating = $user->rating - $category->price;
            $user->update(['rating' => $newRating]);
        }
    }

    /**
     * Handle the task "deleted" event.
     *
     * @param  \App\Models\Task  $task
     * @return void
     */
    public function deleted(Task $task)
    {
        //
    }

    /**
     * Handle the task "restored" event.
     *
     * @param  \App\Models\Task  $task
     * @return void
     */
    public function restored(Task $task)
    {
        //
    }

    /**
     * Handle the task "force deleted" event.
     *
     * @param  \App\Models\Task  $task
     * @return void
     */
    public function forceDeleted(Task $task)
    {
        //
    }


}
