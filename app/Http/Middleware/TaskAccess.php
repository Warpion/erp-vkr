<?php

namespace App\Http\Middleware;

use App\Models\Task;
use Closure;
use Illuminate\Support\Facades\Auth;

class TaskAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $userId = Auth::user()->id;
        $taskId = intval($request->id);
        $taskUserId = Task::query()->find($taskId)->user_id;
        $task = Task::query()->findOrFail($taskId);

        if(isset($task->done_at)) return abort(404);

        if($userId === $taskUserId){
            return $next($request);
        }
        return abort(404);
    }
}
