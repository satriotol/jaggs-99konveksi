<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateHardResetPasswordRequest;
use App\Http\Requests\UpdateUserAdminRequest;
use App\Http\Requests\UpdateUserEmailRequest;
use App\Http\Requests\UpdateUserPasswordRequest;
use App\Http\Requests\UpdateUserRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        return view('user.index')->with('users', $users);
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
        return view('user.createadmin')->with('users', $users);
    }
    public function editadmin(User $user)
    {
        return view('user.editadmin')->with('user', $user);
    }
    public function updateadmin(UpdateUserAdminRequest $request, User $user)
    {
        $user->update([
            'role' => $request['role']
        ]);
        session()->flash('success', 'User Role Update Successfully');
        return redirect(route('user.admin'));
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
        session()->flash('success', 'Order Create Successfully');
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
    public function edit()
    {
        $user = Auth::user();
        return view('user.create', compact('user'));
    }
    public function editemail(User $user)
    {
        return view('user.updateemail')->with('user', $user);
    }
    public function resetpassword(User $user)
    {
        return view('user.resetpassword', compact('user'));
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
        session()->flash('success', 'User Update Successfully');

        return redirect(route('user.index'));
    }
    public function updateemail(UpdateUserEmailRequest $request, User $user)
    {
        $user->update([
            'email' => $request['email']
        ]);
        session()->flash('success', 'Email ' . $user->name . ' Update Successfully');
        return redirect(route('user.edit', $user->id));
    }
    public function editpassword(User $user)
    {
        return view('user.updatepassword')->with('user', $user);
    }
    public function updatepassword(UpdateUserPasswordRequest $request, User $user)
    {
        $user->update([
            'password' => Hash::make($request['new_password'])
        ]);
        session()->flash('success', 'User Password Update Successfully');
        return redirect(route('user.edit', $user->id));
    }
    public function updateresetpassword(UpdateHardResetPasswordRequest $request, User $user)
    {
        $user->update([
            'password' => Hash::make($request['new_password'])
        ]);
        session()->flash('success', 'User Password Update Successfully');
        return redirect(route('user.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if (Auth::user()->id == $user->id) {
            session()->flash('failed', 'You Cannot Deleted Your Account');
            return redirect(route('user.index'));
        } elseif ($user->order()->count() > 0) {
            session()->flash('failed', 'You Cannot Deleted This Account, Because Have A Order, Please Delete Order First');
            return redirect(route('user.index'));
        } else {
            $user->delete();
            $user->order()->delete();
        }
        session()->flash('success', 'User Deleted Successfully');
        return redirect(route('user.index'));
    }
}
