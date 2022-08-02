<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Notification;

use Illuminate\Http\Request;
use \App\Models\User;
use \app\Notifications\WelcomeEmailNotification;
use Illuminate\Support\Facades\Hash;
use App\Notifications\EmailNotification;
class RegisterController extends Controller
{
    protected function create(array $data)
{
    $user = User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password']),
    ]);

    return $user;
}

}
