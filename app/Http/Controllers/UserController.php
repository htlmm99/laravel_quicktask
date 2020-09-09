<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('created_at', 'asc')->get();

        return view('users.index', compact('users'));
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
    public function store(UserRequest $request)
    {
        $user = User::where('email', $request->email)->get();
        if (count($user) > 0) {
            return redirect()->route('users.index')->with('error', trans('message.failExist'));
        }
        User::create($request->all());

        return redirect()->route('users.index')->with('message', trans('message.create_success'));

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
        try {
            $user = User::findOrFail($id);
        }
        catch (ModelNotFoundException $e) {
            return redirect()->route('users.index')->with('error', trans('message.fail'));
        }

        return view('users.edit', compact('user'));
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
            $user = User::findOrFail($id);
        }
        catch (ModelNotFoundException $e) {
            return redirect()->route('users.index')->with('error', trans('message.fail'));
        }
        $user->update($request->all());

        return redirect()->route('users.index')->with('message', trans('message.edit_success'));
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
            $user = User::findOrFail($id);
        }
        catch (ModelNotFoundException $e) {
            return redirect()->route('users.index')->with('error', trans('message.fail'));
        }
        $user->delete();

        return redirect()->route('users.index')->with('message', trans('message.delete_success'));
    }
}
