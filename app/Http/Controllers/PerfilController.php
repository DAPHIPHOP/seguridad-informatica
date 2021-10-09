<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class PerfilController extends Controller
{
    public function index()
    {
        $perfiles=Role::all();
        return view('admin.profile.index', ['perfiles'=>$perfiles]);
    }

    public function edit($id)
    {
        $rol=Role::find($id);
        return view('admin.profile.edit', ['rol'=>$rol]);
    }

    public function update(Request $request, $id)
    {
        $rol=Role::find($id);
        $rol->update($request->all());
        return redirect()->route('perfil.index')->with('updated', 'true');
        ;
    }

    public function updateState(Request $request, $id)
    {
        $rol=Role::find($id);
        $actual_state=$rol->status;

        $new_state='';
        if ($actual_state=='Activo') {
            $new_state='Inactivo';
        } else {
            $new_state='Activo';
        }

        $rol->status=$new_state;
        $rol->save();



        return  response()->json(['message'=>'Estado actualizado']);
    }


    public function destroy($id)
    {
        $user=Role::find($id);

        $user->delete();
        return response()->json(['message'=>'Perfil eliminado']);
    }
}
