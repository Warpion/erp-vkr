<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskCheckController extends Controller
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

        $tasks = Task::query()->whereNotNull('done_at')->whereNull('accept')->with('user')->get();
        return view('task.check', compact('tasks', 'user', 'role'));
    }


    public function accept($id)
    {
        $task = Task::query()->find($id);
        $task->update(['accept' => 1]);
        return redirect()->route('task.check');
    }


    public function decline($id)
    {
        $task = Task::query()->find($id);
        $task->update(['accept' => 0]);
        return redirect()->route('task.check');
    }

    public function restart($id)
    {
        $task = Task::query()->find($id);
        $task->update(['accept' => 0]);

        Task::query()->create([
            'title' => $task ->title,
            'description' => $task->description,
            'category_id' => $task->category_id,
            'project_id' => $task->project_id,
            'order' => $task->order,
        ]);

        return redirect()->route('task.check');
    }

    public function deleteResult($id)
    {
        $task = Task::query()->find($id);
        $profit = $task->profit;
        $userId = $task->user_id;
        $task->delete();

        $user = User::query()->findOrFail($userId);
        $newRating = $user->rating - $profit;
        $user->update(['rating' => $newRating]);

        return redirect()->route('user.admin.show', ['id' => $userId]);
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
