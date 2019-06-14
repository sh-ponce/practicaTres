<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Relacion;

class RegistroPracThree extends Controller
{
    public function registrarUsuario(Request $request)
    {
        $usuario = $request->get('usuario');

        $relacion = new Relacion;
        $relacion->nombre = $usuario['nombre'];
        $relacion->apellido = $usuario['apellido'];
        $relacion->edad = $usuario['edad'];
        $relacion->telefono = $usuario['telefono'];
        $relacion->save();

        if($relacion){
            return "1";
        }else{
            return "Usuario no registrado";
        }
    }

    public function obtenerRegistros(Request $request)
    {
        return Relacion::all();
    }
    public function eliminarUsuario($id)
    {
        $usuario = Relacion::find($id);

        if($usuario->delete())
        return 'true';

        return 'false';
    }

    public function editarUsuario(Request $request)
    {
        $data = $request->get('usuario');

        $user = Relacion::find($data['id']);
        $user->nombre = $data['nombre'];
        $user->apellido = $data['apellido'];
        $user->edad = $data['edad'];
        $user->telefono = $data['telefono'];
        $user->save();
        return "true";
    }
}
