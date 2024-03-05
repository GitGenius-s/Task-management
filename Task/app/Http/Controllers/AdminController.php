<?php

namespace App\Http\Controllers;

use App\Assigns;
use App\Jobs\DeleteUpdateEmail;
use App\Jobs\UpdateEmail;
use App\Mail\AssignMail;
use App\Jobs\UpdateEmailJob;
use App\Task;
use App\User;
use App\Insights;
use App\Jobs\SendEmailJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=$request->validate([
            'parent_id'=>'nullable|integer|exists:tasks,task_id',
            'task_name'=>'required',
            'created_date' => 'required|date',
            'due_date'=>'required|date',
        ]);
        $task=Task::create($data);
        return "saved";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        // $task=Task::all();
        $tasksWithSubtasks = Task::with('subtasks')->get();
        return response()->json($tasksWithSubtasks, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showUserTask($id)
    {
        $user=User::findOrFail($id);
        $assignedTasks = $user->assignedTasks;
        return response()->json($assignedTasks, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task=Task::findOrFail($id);
        $assignedUsers=$task->assignedUsers()->get();
        // dd($assignedUsers);
        foreach($assignedUsers as $user)
        {
            $array=[
                'user_name'=>$user->name,
                'user_email'=>$user->email,
                'task_name'=>$task->task_id
            ];
            dispatch(new DeleteUpdateEmail($array));
        }
        // return response()->json($assignedUsers,200);
    }

    public function assign(Request $request)
    {
        // $data='selva';
        $data=$request->validate([
            'user_id'=>'required|integer',
            'task_id'=>'required|integer',
            'status' => 'required|integer',
            'assign_date'=>'required|date',
            'completed_date'=> 'nullable|date',
        ]);
        $assign=Assigns::create($data);
        // dd($assign);
        // Auth::shouldUse('api');
        // $auth_user = Auth::user();
        // dd($auth_user);
        $user=User::find($request->user_id);
        // Insights::where('user_id', $request->user_id)->increment('no_of_task');
        Insights::present($request->user_id);
        $task=Task::find($request->task_id);
        $array=[
            'name' => $user->name,
            'email' => $user->email,
            'task_name' => $task->task_name,
        ];
        // $queue = SendEmailJob::dispatch($data)->onQueue('emails');
        // \Log::info($queue);
        dispatch(new SendEmailJob($array));
        return 'hi';
    }

    public function update(Request $request)
    {
        $data=$request->validate([
            'task_id'=>'required|integer',
            'task_name'=>'required|string',
        ]);
        // dd('hi');
        // Task::where('task_id',$request->task_id)->update('task_name',$request->task_name);
        $old_task_name=Task::where('task_id',$request->task_id)->pluck('task_name')->first();
        Task::where('task_id', $request->task_id)->update(['task_name' => $request->task_name]);
        $assigns=Assigns::where('task_id',$request->task_id)->get()->toArray();
        // dd($assigns);
        foreach($assigns as $assign)
        {
            $user=User::where('id',$assign['user_id'])->first();
            // dd($user->id);
            $task=Task::where('task_id',$request->task_id)->first();
            // dd($task_id);
            // dd($user);
            $array=[
                'user_name'=>$user->name,
                'user_email' => $user->email,
                'task_name'=>$task->task_name,
                'old_task_name'=>$old_task_name,
            ];
            // dd($array['user']->name);
            // dd($array);
            dispatch(new UpdateEmailJob($array));
        }
    }
}
