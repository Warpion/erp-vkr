<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends MainController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::orderBy('id', 'desc')->paginate(5);
        return view('project.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('project.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'urgency' => 'required|digits_between:1,3',
        ]);
        $project = new Project([
            'title' => $request->title,
            'urgency' => $request->urgency,
            'user_id' => Auth::user()->id,
        ]);
        $project->save();

        return redirect()->route('projects.edit', [$project->id]);
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
        $project =  Project::findOrFail($id);
        $tasks = $project->tasks;

        foreach ($tasks as $key => $task) {
            if($task->category->tasks_complete > 9){
                $tasks[$key]['time'] = gmdate('H:i', intval($task->category->time_avg));
            }
            else{
                $tasks[$key]['time'] = $task->category->time;
            }
        }

        $time = $project->getTimeSum();
        return view('project.edit', compact('project', 'time'));
    }

    public function editProject($id)
    {
        $project = Project::query()->findOrFail($id);
        return view('project.editproject', compact('project'));
    }

    public function editProjectStore(Request $request)
    {

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
    public function destroy(Project $project)
    {
        $project->tasks()->delete();
        $project->delete();
        return redirect()->route('projects.index');
    }

}



