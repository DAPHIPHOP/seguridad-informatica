<?php

namespace App\Http\Controllers;

use App\Mail\UserCredentials;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function store(Request $request)
    {
        $username=$request->dni .'-'.substr(uniqid(rand(), true), 4, 4);

        $password=Hash::make($username);
        $user=new User();
        $user->name=$request->name;
        $user->last_name=$request->last_name;
        $user->username=$username;
        $user->email=$request->email;
        $user->password=$password;
        $user->save();

        $user->passwords()->create(['password'=> $password,'is_default'=>true]);

        Mail::to($request->email)->send(new UserCredentials($user, $username, $username));

        return back();

        //$user->assignRole('Admin');
    }

    public function updatePassword(Request $request)
    {
        $password=Hash::make($request->password);
        $user=auth()->user();
        $user->password=$password;
        $user->save();

        $user->passwords()->create(['password'=> $password]);

        return redirect()->route('home');
    }
}
