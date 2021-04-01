<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ProjectRequest;
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
        $projects = Project::orderBy('id', 'desc')->paginate(8);

        $user = Auth::user();
        $role = ($user->role < 3)? true : false;

        return view('project.index', compact('projects', 'user', 'role'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        $role = ($user->role < 3)? true : false;

        return view('project.create', compact('user', 'role'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectRequest $request)
    {
        $project = new Project([
            'title' => $request->title,
            'urgency' => $request->urgency,
            'user_id' => Auth::user()->id,
        ]);
        $project->save();

        return redirect()->route('projects.edit', ["id" => $project->id, "project" => $project]);
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

        $user = Auth::user();
        $role = ($user->role < 3)? true : false;

        $totalTime = $project->getTimeSum();
        $tasks = $project->getTasksChartInfo();

        $time = gmdate('H:i:s', $totalTime);

        $maxTime = intval(floor($totalTime / 3600) );

        return view('project.edit', compact('project', 'time', 'user', 'role', 'tasks', 'maxTime'));
    }

    public function editProject($id)
    {
        $project = Project::query()->findOrFail($id);

        $user = Auth::user();
        $role = ($user->role < 3)? true : false;

        return view('project.editproject', compact('project', 'user', 'role'));
    }

    public function editProjectStore(ProjectRequest $request, $id)
    {
        $project = Project::find($id);
        $project->update($request->all());
        return redirect()->route('projects.edit', [$project->id]);
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



