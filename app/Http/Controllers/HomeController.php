<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

       $user=auth()->user();
       if($user->hasRole('Admin')){
        $usuarios=User::all();
        return view('home', ['usuarios'=>$usuarios]);
       }else{
        return view('simple-user');
       }

    }

    public function logued()
    {
        $user=auth()->user();
        //Verificar primer cambio de contraseña
        if ($user->passwords->where('is_default', 0)->count()<1) {
            return view('change-password',['message'=>'Debe cambiar  la contraseña por defecto']);
        }else{

        }

        return redirect()->route('home');
    }
}
