<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TaskRequest;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::orderBy('created_at', 'asc')->get();

        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tasks.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaskRequest $request)
    {
        Task::create($request->all());

        return redirect()->route('tasks.index')->with('message', trans('message.create_success'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $task = Task::findOrFail($id);
        }
        catch (ModelNotFoundException $e) {
            return redirect()->route('tasks.index')->with('error', trans('message.fail'));
        }
        $taskUsers = $task->users()->orderBy('name', 'asc')->get();

        return view('tasks.show', compact('task', 'taskUsers'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $task = Task::findOrFail($id);
        }
        catch (ModelNotFoundException $e) {
            return redirect()->route('tasks.index')->with('error', trans('message.fail'));
        }

        return view('tasks.edit', compact('task'));
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
        try {
            $task = Task::findOrFail($id);
        }
        catch (ModelNotFoundException $e) {
            return redirect()->route('tasks.index')->with('error', trans('message.fail'));
        }
        $task->update($request->all());

        return redirect()->route('tasks.index')->with('message', trans('message.edit_success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $task = Task::findOrFail($id);
        }
        catch (ModelNotFoundException $e) {
            return redirect()->route('tasks.index')->with('error', trans('message.fail'));
        }
        $task->delete();

        return redirect()->route('tasks.index')->with('message', trans('message.delete_success'));
    }

    public function addUser(Request $request, $id)
    {
        try {
            $task = Task::findOrFail($id);
        }
        catch (ModelNotFoundException $e) {
            return redirect()->route('tasks.show', $id)->with('error', trans('message.fail'));
        }
        $user = User::where('email', $request->email)->first();
        if ($user == null) {
            return redirect()->route('tasks.show', $id)->with('error', trans('message.fail'));
        }
        $taskUsers = $task->users()->where('user_id', $user->id)->get();
        if (count($taskUsers)) {
            return redirect()->route('tasks.show', $id)->with('error', trans('message.failExist'));
        }
        $task->users()->attach($user->id);

        return redirect()->route('tasks.show', $id)->with('message', trans('message.create_success'));

    }

    public function deleteUser($task_id, $user_id)
    {
        try {
            $task = Task::findOrFail($task_id);
        }
        catch (ModelNotFoundException $e) {
            return redirect()->route('tasks.show', $task_id)->with('error', trans('message.fail'));
        }
        $taskUsers = $task->users()->where('user_id', $user_id)->get();
        if (count($taskUsers)) {
            $task->users()->detach($user_id);

            return redirect()->route('tasks.show', $task_id)->with('message', trans('message.delete_success'));
        }

        return redirect()->route('tasks.show', $task_id)->with('error', trans('message.fail'));
    }

}
