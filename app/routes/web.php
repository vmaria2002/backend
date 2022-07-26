<?php

use App\Http\Controllers\MailController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;
use App\Mail\TestMail;
use app\Mail;
use App\Http\Livewire\Crud;
/*
use 
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});



// Route::view('index', 'insertCRUD');

// Route::view('update', 'updateviewCRUD');

Route::resource('tasks', \App\Http\Controllers\TaskController::class);
Route::resource('users', \App\Http\Controllers\UserController::class);
