<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;

class AdminController extends Controller
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
        $data=$request->validate([
            'parent_id'=>'nullable|integer|exists:tasks,task_id',
            'task_name'=>'required',
            'created_date' => 'required|date',
            'due_date'=>'required|date',
        ]);
        // dd("hi");
        // $task = new Task();
        // $task->parent_id = $request['parent_id'];
        // $task->task_name = $request['task_name'];   
        // $task->created_date = $request['created_date'];
        // $task->due_date = $request['due_date'];
        // $task->save();
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
