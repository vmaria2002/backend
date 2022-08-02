<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Notification;

use App\Models\User;
use Illuminate\Http\Request;
use App\Notifications\EmailNotification;

class HomeController extends Controller
{

    function index()
    {
        
        return view('emails.welcome');
    }
 

    public function send() 
    {
    	$user = User::latest()->first();
  
        $project = [
            'greeting' => 'Hi '.$user->name.',',
            'body' => 'This is the project assigned to you.',
            'thanks' => 'Thank you this is from codeanddeploy.com',
            'actionText' => 'View Project',
            'actionURL' => url('/'),
            'id' => 1
        ];
  
        Notification::send($user, new EmailNotification($project));
   
        return view('emails.welcome');
    }
}