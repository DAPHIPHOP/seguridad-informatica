<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Spatie\Permission\Models\Role;

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
      $roles=Role::whereStatus('Activo')->get();
       $user=auth()->user();
       if($user->hasRole('Admin')){
        $usuarios=User::all();
        return view('home', ['usuarios'=>$usuarios,'roles'=>$roles]);
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
        $passwords=$user->passwords->sortByDesc('created_at')->take(1);

        $dias_trasncurridos=$passwords->first()->created_at->diffInDays(Carbon::now());

        if($dias_trasncurridos>=30){
            return view('change-password',['message'=>'Han pasado '. $dias_trasncurridos. ' dias desde el ultimo de contraseña , actualizela por favor .']);
        }


        return redirect()->route('home');
    }
}
