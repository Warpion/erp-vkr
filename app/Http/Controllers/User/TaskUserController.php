<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class TaskUserController extends Controller
{
    public function orderTask($id)
    {
        $task = Task::find($id);
        $task->update([
            'user_id' => Auth::user()->id,
        ]);
        return redirect()->route('taskUser.show', compact('id'));
    }

    public function startTask($id)
    {
        $task = Task::find($id);
        $task->update([
            'started_at' => Carbon::now(),
        ]);
        return redirect()->route('taskUser.show', compact('id'));
    }

    public function doneTask($id)
    {
        $task = Task::find($id);
        $task->update([
            'done_at' => Carbon::now(),
        ]);
        return redirect()->route('dashboard');
    }

    public function show($id)
    {
        $task = Task::findOrFail($id);


        if($task->started_at !== null){
            $buttonContent = 'Задание выполнено';
            $formAction = route('taskUser.doneTask', [$task->id]);
            $start = $task->started_at;
        } else {
            $buttonContent = 'Начать выполнение';
            $formAction = route('taskUser.startTask', [$task->id]);
            $start = null;
        }


        return view('dashboard.task.show', compact('task', 'buttonContent', 'formAction', 'start'));
    }
}
