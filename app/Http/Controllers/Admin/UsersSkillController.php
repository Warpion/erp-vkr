<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use App\Models\User;
use App\Models\Usersskill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersSkillController extends Controller
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
    public function edit($id, $skill_id)
    {
        $user = Auth::user();
        $role = ($user->role < 3)? true : false;
        $employee = User::query()->findOrFail($id);
        $userSkill = Usersskill::query()->findOrFail($skill_id);

        return view('skill.edituser', compact('role', 'employee', 'userSkill', 'user'));
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
        $request->validate([
            'rating' => 'required|integer',
        ]);
        $userSkill = Usersskill::query()->findOrFail($id);
        $userSkill->update([
            'rating' => $request->rating,
        ]);

        $userId = $userSkill->user_id;

        return redirect()->route('user.admin.show', [$userId]);
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
