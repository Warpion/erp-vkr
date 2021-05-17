<?php

namespace App\Observers;

use App\Models\Category;
use App\Models\Skill;
use App\Models\Task;
use App\Models\User;
use App\Models\Usersskill;

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
    public function updating(Task $task)
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
            $profit = setTaskPrice($category->rating, $category->price, $user->rating, $task->project->urgency);
            $newRating = $user->rating + $profit;
            $user->update(['rating' => $newRating]);
            $task->profit = $profit;

            $userSkill = Usersskill::query()->where('user_id', '=', $task->user_id)
                ->where('skill_id', '=', $category->skill_id);

            if($userSkill->count() === 1) {
                $skill = $userSkill->first();
                $skill->update(['rating'=> $skill->rating + $profit]);
            }
            else {
                Usersskill::query()->create([
                    'user_id' => $task->user_id,
                    'skill_id' => $category->skill_id,
                    'rating' => $profit,
                ]);
            }



        }
        if($task->accept === 0) {
            $user = User::query()->find($task->user_id);
            $category = Category::query()->find($task->category_id);
            $newRating = $user->rating - $category->price;
            $user->update(['rating' => $newRating]);
            $task->profit = -$category->price;

            $userSkill = Usersskill::query()->where('user_id', '=', $task->user_id)
                ->where('skill_id', '=', $category->skill_id);

            if($userSkill->count() === 1) {
                $skill = $userSkill->first();
                $skillRating = ($skill->rating - $category->price) > 0 ? $skill->rating - $category->price : 0;
                $skill->update(['rating'=> $skillRating]);
            }
            else {
                Usersskill::query()->create([
                    'user_id' => $task->user_id,
                    'skill_id' => $category->skill_id,
                    'rating' => 0,
                ]);
            }

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
