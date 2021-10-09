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
        $user->dni=$request->dni;
        $user->last_name=$request->last_name;
        $user->username=$username;
        $user->email=$request->email;
        $user->password=$password;
        $user->save();

        $user->passwords()->create(['password'=> $password,'is_default'=>true]);
        $user->assignRole($request->rol);
        Mail::to($request->email)->send(new UserCredentials($user, $username, $username));

        return back()->with('created', 'true');
        ;

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


    public function edit($id)
    {
        $user=User::find($id);
        return view('admin.user.edit', ['user'=>$user]);
    }

    public function update(Request $request, $id)
    {
        $user=User::find($id);
        $user->update($request->all());
        return redirect()->route('home')->with('updated', 'true');
        ;
    }

    public function destroy($id)
    {
        $user=User::find($id);
        $user->passwords()->delete();
        $user->delete();
        return redirect()->route('home')->with('destroyed', 'true');
    }


    public function changePassword()
    {
        return view('change-password', ['message'=>'']);
    }

    public function validarContrasenia(Request $request)
    {
        $user=auth()->user();
        $passwords=$user->passwords->sortByDesc('created_at')->take(5);

        foreach ($passwords as $password) {
            if (Hash::check($request->password, $password->password)) {
                return 'false';
            }
        }


        return 'true';
    }

    public function updateState(Request $request, $id)
    {
        $user=User::find($id);
        $actual_state=$user->state;
        $new_state='';
        if ($actual_state=='Activo') {
            $new_state='Inactivo';
        } else {
            $new_state='Activo';
        }

        $user->state=$new_state;
        $user->save();

        return  response()->json(['message'=>'Estado actualizado']);
    }
}
