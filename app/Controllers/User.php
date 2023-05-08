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
        if(session('id_rol') != '1'){
            return redirect()->to(base_url(''));
        }

        $usuario = new Users();
        $datos['usuarios'] = $usuario->orderBy('id','ASC')->findAll();
        $titulo = "Usuarios";
        return view('usuarios/index',['titulo' => $titulo],$datos);
    }
    
    public function crear()
    {
        if ($this->validarSesion()) {
            return redirect()->to(base_url(''));
        }
        $titulo = "Usuarios";
        return view('usuarios/crear',['titulo' => $titulo]);
    }

    public function guardar(){

        if ($this->validarSesion()) {
            return redirect()->to(base_url(''));
        }
        
        $users = new Users();
        $usuario = $this->request->getPost('usuario');
        $password = $this->request->getPost('password');
        $id_persona = $this->request->getPost('id_persona');
        $id_rol = $this->request->getPost('id_rol');
        $imagen = $this->request->getPost('imagen');
        $estado = 1;

        $existePersona = $users->validarPersona($id_persona);
        if (is_array($existePersona) && count($existePersona) > 0) {
            //return redirect()->back()->withInput()->with('mensaje', 'La persona seleccionada ya tiene un usuario creado');
            $session = session();
            $session->setFlashData('mensaje','La persona seleccionada ya tiene un usuario creado');
            return $this->response->redirect(base_url('UsuariosCrear'));
        }

        $validacion = $this->validate([
            'usuario'=>'required|min_length[6]',
            'password'=>'required|min_length[8]',
            'id_persona' => 'required|numeric',
            'id_rol' => 'required|numeric',
            'imagen' => [
                'uploaded[imagen]',
                'mime_in[imagen,image/jpg,image/jpeg,image/png]',
                'max_size[imagen,1024]',
            ]
        ]);

        if(!$validacion){
            $session = session();
            $session->setFlashData('mensaje','Hay campos vacios, por favor completar el formulario');
            return $this->response->redirect(base_url('UsuariosCrear'));
        }


        if($imagen=$this->request->getFile('imagen')){
            $nuevoNombre=$imagen->getRandomName();
            $ruta = '../public/users/img/';
            $imagen->move($ruta,$nuevoNombre);
            $imagenNombre = $ruta .  $nuevoNombre;
            // Hash la contraseña
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            // Crea el nuevo usuario
            $usuarioNuevo = ['usuario' => $usuario, 'password' => $passwordHash, 'id_persona' => $id_persona, 'id_rol' => $id_rol, 'estado' => $estado, 'imagen' => $imagenNombre];
            $users->guardar($usuarioNuevo);
        }
        return redirect()->to(base_url('usuarios'))->with('mensaje', 'Usuario creado exitosamente');
    }

   
}