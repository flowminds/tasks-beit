<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;

use App\Http\Requests;
use App\Task;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::ofUser()
            ->orderBy('id', 'desc')
            ->get();
        
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  TaskRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaskRequest $request)
    {
        Task::create(
            array_merge(
                $request->all(),
                ['user_id' => auth()->user()->id]
            )
        );

        return redirect()->route('tasks.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  TaskRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TaskRequest $request, $id)
    {
        $task = Task::findOrFail($id);

        $task->update($request->only(['task']));

        return $task;
    }

    public function complete($id)
    {
        $task = Task::findOrFail($id);

        $task->complete();
    }

    public function incomplete($id)
    {
        $task = Task::findOrFail($id);

        $task->incomplete();
    }
}
