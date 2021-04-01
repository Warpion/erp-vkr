<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $role = ($user->role < 3)? true : false;

        $currentTasks = Task::query()->select('categories.rating', 'categories.price', 'categories.time', 'categories.time_avg', 'categories.tasks_complete',
            'tasks.title', 'tasks.user_id', 'tasks.id as taskId', 'projects.urgency', 'tasks.title', 'tasks.started_at', 'tasks.accept', 'categories.title as ctitle')
            ->join('categories','categories.id', '=', 'tasks.category_id')
            ->join('projects', 'projects.id', '=', 'tasks.project_id')
            ->where('tasks.user_id', '=', $user->id)
            ->whereNull('tasks.done_at')
            ->orderBy('projects.urgency')
            ->get();
        foreach ($currentTasks as $key => $item) {
            $currentTasks[$key]['setPrice'] = setTaskPrice($item['rating'], $item['price'], $user->rating, $item['urgency']);
            if($item['tasks_complete'] > 9) {
                $currentTasks[$key]['approxTime'] = gmdate('H:i', $currentTasks[$key]['time_avg']);
            }
            else {
                $currentTasks[$key]['approxTime'] = gmdate('H:i', $currentTasks[$key]['time']);
            }
        }

//        dd($currentTasks);
        return view('dashboard.index', compact('user', 'currentTasks', 'role'));
    }

    public function task(Task $task)
    {
        $tasks = $task->getTasks();
        $user = Auth::user();
        $role = ($user->role < 3)? true : false;

        return view('dashboard.task.index', compact('tasks', 'user', 'role'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
