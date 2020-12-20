<?php

namespace App\Http\Controllers\Teams;

use App\Events\SendNewPost;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Team;
use App\Models\User;
use Illuminate\Console\Scheduling\Event;
use Illuminate\Http\Request;


class TeamChatController extends Controller
{
    public function index (Team $team) {
        return view('pages.Teams.team',compact('team'));

    }


    public function posts (Team $team) {
        return $team->posts()->with('user')->get();
    }


    public function post (Request $request) {
      $post =  Post::create([
            'user_id'=>$request->userid,
            'team_id'=>$request->teamid,
            'content'=>$request->post,
        ]);
      $user = User::where('id',$request->userid)->first();

        SendNewPost::dispatch($user->id,$user->gender,$user->fullname,$user->avatar,$post->content,$post->created_at);
    }
}
