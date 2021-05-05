<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\TaskRequest;
use App\Http\Requests\TaskUpdateRequest;
use App\Models\Category;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TaskController extends MainController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $project= Project::query()->select('title')->find($id);
        $categories = Category::all();

        $user = Auth::user();
        $role = ($user->role < 3)? true : false;

        $employeeList = User::all();

        return view('task.add', ['id' => $id, 'categories' => $categories,
            'projectTitle' => $project->title, 'user' => $user, 'role' => $role,
            'employeeList' => $employeeList,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaskRequest $request)
    {
        $id = $request->id;

        Task::query()->create([
            'title' => $request->title,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'project_id' => $request->project_id,
            'user_id' => $request->user_id,
            'order' => $request->order,
        ]);

        return redirect()->route('projects.edit', [$id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect()->route('tasks.edit', [$id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::all();
        $task = Task::findOrFail($id);

        $user = Auth::user();
        $role = ($user->role < 3)? true : false;

        return view('task.edit', compact('id','task', 'categories', 'user', 'role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TaskUpdateRequest $request, $id)
    {
        $task = Task::find($id);
        $task->update($request->all());
        return redirect()->route('projects.edit', [$task->project->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::find($id);
        $project_id = $task->project_id;
        $task->delete();
        return redirect()->route('projects.show', [$project_id]);
    }
}
