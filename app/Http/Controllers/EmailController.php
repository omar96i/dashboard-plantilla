<?php

namespace App\Http\Controllers;

use App\Models\Users\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function sendEmail($datos, User $user){
        Mail::to($user->email)->send(new \App\Mail\sendEmail($datos));
    }
}
