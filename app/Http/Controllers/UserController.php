<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserEmailRequest;
use App\Http\Requests\UpdateUserRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('user.index')->with('users',$users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
    }

    public function createadmin()
    {
        $users = User::all();
        return view('user.createadmin')->with('users',$users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {
        //
        User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'phone_number' => $request['phone_number'],
            'password' => Hash::make($request['password']),
        ]);
        session()->flash('success','Order Create Successfully');
        return redirect(route('user.index'));
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
    public function edit(User $user)
    {
        return view('user.create')->with('user',$user);
    }
    public function editemail(User $user)
    {
        return view('user.updateemail')->with('user',$user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update([
            'name' => $request['name'],
            'email' => $request['email'],
            'phone_number' => $request['phone_number'],
            'password' => Hash::make($request['password']),
        ]);
        session()->flash('success','Tag Update Successfully');

        return redirect(route('home'));
    }
    public function updateemail(UpdateUserEmailRequest $request,User $user)
    {
        $user->update([
            'email' => $request['email']
        ]);
        session()->flash('success','Tag Update Successfully');
        return redirect(route('home'));
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
