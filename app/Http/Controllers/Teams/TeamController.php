<?php

namespace App\Http\Controllers\Teams;

use App\Http\Controllers\Controller;
use App\Http\Requests\Team\StoreTeam;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::find(auth()->id());
        $teams= $user->teams;
        $teamsjoined =$user->teamsjoined;
        return view('Pages/Teams/teams',compact('teams','teamsjoined'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Pages.Teams.new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTeam $request)
    {
        $user = User::find(auth()->id());
        $user->teams()->create($request->validated());
        return  redirect()->route('teams.teams')->with('success', 'Team Was Created Successfully ');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function show(Team $team)
    {
        $manager     =$team->manager()->get()->first();
        $members     = $team->members();
        $assignments = $team->assignments();
        $posts       = $team->posts();
        return view('pages/Teams/info',compact('team' ,'manager','members', 'assignments','posts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function edit(Team $team)
    {
        if ($team->manager_id == auth()->id()){
            return view('Pages.Teams.edit',compact('team'));
        }
        else{
            abort('403');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function update(StoreTeam $request, Team $team)
    {
        if ($team->manager_id == auth()->id()){
            $team->update($request->validated());
            return redirect()->route('teams.teamInfo',[$team->id])->with('success', 'Team Was Updated Successfully ');
        }
        else
            {
            abort('403');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function destroy(Team $team)
    {
        if ($team->manager_id == auth()->id()){
            $team->delete();
            return redirect()->route('teams.teams')->with('success', 'Team Was Deleted Successfully ');
        }
        else{
            abort('403');
        }

    }

}
