<?php

namespace App\Http\Controllers;

use App\Assigns;
use App\Http\Resources\UserResource;
use App\Insights;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function showUserTask()
    {
        Auth::shouldUse('api');
        $auth_user = Auth::user();
        // return response()->json($auth_user, 200);
        // dd($auth_user);
        $assignedTasks = $auth_user->assignedTasks;
        // return new UserResource($auth_user);
        return response()->json($auth_user, 200);
    }
    public function update($task_id)
    {
        Auth::shouldUse('api');
        $auth_user=Auth::user();
        Assigns::change($auth_user->id,$task_id);
        $assign=Assigns::where('user_id',$auth_user->id)->where('task_id',$task_id)->first();
        return response()->json($assign,200);
    }
    public function users()
    {
        $users=User::get();
        return UserResource::collection($users);
    }
}
