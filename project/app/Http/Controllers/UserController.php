<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function index()
    {
       
        $users = User::with('roles')->get();

        return view('users.index', compact('users'));
    }

    // public function create()
    // {
       
    //     $roles = Role::pluck('name', 'id');

    //     return view('users.create', compact('roles'));
    // }

    // public function store(StoreUserRequest $request)
    // {
        
        
    //     // $user = User::create($request->validated());
    //     $user=new User();
    //     $user->name=$request->input('name');
    //     $user->email=$request->input('email');
    //     $user->password=$request->input('password');
    //     // $user->roles()->sync($request->input('roles', []));
    //     return redirect()->route('users.index');
    // }



    public function create()
    {


        $roles = Role::pluck('title', 'id');

        return view('users.create', compact('roles'));
    }

    public function store(StoreUserRequest $request)
    {
        $user = User::create($request->validated());
        $user->roles()->sync($request->input('roles', []));

        return redirect()->route('users.index');
    }

    public function show(User $user)
    {
        
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
      
        $roles = Role::pluck('name', 'id');

        $user->load('roles');

        return view('users.edit', compact('user', 'roles'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->validated());
        $user->roles()->sync($request->input('roles', []));

        return redirect()->route('users.index');
    }

    public function destroy(User $user)
    {
        
        $user->delete();

        return redirect()->route('users.index');
    }
}