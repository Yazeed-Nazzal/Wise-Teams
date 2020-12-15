<?php

namespace App\Http\Controllers\Teams;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Http\Request;

class TeamChatController extends Controller
{
    public function index (Team $team) {
        return view('pages.Teams.team',compact('team'));

    }
}
