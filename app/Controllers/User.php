<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\Users;

class User extends BaseController
{
    
    public function index()
    {
        if ($this->validarSesion()) {
            return redirect()->to(base_url(''));
        }
        $titulo = "Usuarios";
        return view('usuarios/index',['titulo' => $titulo]);
    }

    public function guardar(){
        $users = new Users();
        $usuario = $this->request->getPost('usuario');
        $password = $this->request->getPost('password');
        $id_persona = 1;
        $id_rol = 1;
        $estado = 1;
        // Hash la contraseña
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        // Crea el nuevo usuario
        $usuarioNuevo = ['usuario' => $usuario, 'password' => $passwordHash, 'id_persona' => $id_persona, 'id_rol' => $id_rol, 'estado' => $estado];
        $users->guardar($usuarioNuevo);
    
        echo [$usuarioNuevo];
        #return redirect()->to(base_url('dashboard'))->with('mensaje', 'Usuario creado exitosamente');
    }
}