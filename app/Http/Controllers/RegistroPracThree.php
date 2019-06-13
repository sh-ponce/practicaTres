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
}
