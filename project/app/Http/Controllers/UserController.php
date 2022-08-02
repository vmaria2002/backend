<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Notification;
use App\Notifications\EmailNotification;

class UserController extends Controller

{
    public function index()
    {
       
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, "You don't have permission for access this page!! Sorry!");
        $users = User::with('roles')->paginate(5);
        
        $user = User::latest()->first();

        // $project = [
        //     'greeting' => 'Succes register!!Hi '.$user->name.',',
        //     'body' => 'This is the project assigned to you.',
        //     'thanks' => 'Thank you this is from codeanddeploy.com',
        //     'actionText' => 'View Project',
        //     'actionURL' => url('/'),
        //     'id' => 1
        // ];
        // Notification::send($user, new EmailNotification($project));
        // dd('Notification sent!');
        return view('users.index', compact('users'));
    }

    public function create()
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, "You don't have permission for access this page!! Sorry!");

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
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, "You don't have permission for access this page!! Sorry!");
        $roles = Role::pluck('title', 'id');

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
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, "You don't have permission for access this page!! Sorry!");

        $user->delete();

        return redirect()->route('users.index');
    }
}


