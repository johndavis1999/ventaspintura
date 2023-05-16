<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\Users;
use App\Models\Personas;
use App\Models\Roles;

class User extends BaseController
{
    
    public function index()
    {
        $user = new Users();
        $data['usuarios'] = $user->select('usuarios.*, personas.nombres as persona, roles.descripcion as rol_usuario')
                                    ->join('personas', 'personas.id = usuarios.id_persona', 'left')
                                    ->join('roles', 'roles.id = usuarios.id_rol', 'left')
                                    ->orderBy('usuarios.id', 'ASC')
                                    ->findAll();
        $titulo = "Usuarios";
        $data['titulo'] = $titulo;
        return view('usuarios/index', $data);

    }
    
    public function crear()
    {
        $titulo = "Usuarios";
        $data['titulo'] = $titulo;
        return view('usuarios/crear', $data);
    }

    public function guardar(){
        
        $users = new Users();
        $usuario = $this->request->getPost('usuario');
        $password = $this->request->getPost('password');
        $id_persona = $this->request->getPost('id_persona');
        $id_rol = $this->request->getPost('id_rol');
        #$imagen = $this->request->getPost('imagen');
        $imagen = $this->request->getFile('imagen');
        $estado = 1;

        //Validar si la persona seleccionada ya tiene un usuario creado
        $existePersona = $users->validarPersona($id_persona);
        if (is_array($existePersona) && count($existePersona) > 0) {
            //return redirect()->back()->withInput()->with('mensaje', 'La persona seleccionada ya tiene un usuario creado');
            $session = session();
            $session->setFlashData('mensaje','La persona seleccionada ya tiene un usuario creado');
            return $this->response->redirect(base_url('UsuariosCrear'));
        }

        //validar si el nombre de usuario ya esta en uso
        $usuarioExise = $users->obtenerUsuario($usuario);
        if (is_array($usuarioExise) && count($usuarioExise) > 0) {
            //return redirect()->back()->withInput()->with('mensaje', 'La persona seleccionada ya tiene un usuario creado');
            $session = session();
            $session->setFlashData('mensaje','Ya existe un usuario con ese nombre');
            return $this->response->redirect(base_url('UsuariosCrear'));
        }

        $validacion = $this->validate([
            'usuario'=>'required|min_length[6]',
            'password'=>'required|min_length[8]',
            'id_persona' => 'required|numeric',
            'id_rol' => 'required|numeric'
        ]);
        if(!$validacion){
            $session = session();
            $session->setFlashData('mensaje','Hay campos vacios, por favor completar el formulario');
            return $this->response->redirect(base_url('UsuariosCrear'));
        }
        if ($imagen && !$imagen->hasMoved()) {
            $validarImagen = $this->validate([
                'imagen' => [
                    'if_exist',
                    'uploaded_file[imagen]',
                    'mime_in[imagen,image/jpg,image/jpeg,image/png]',
                    'max_size[imagen,1000]'
                ]
            ]);
        
            if(!$validarImagen){
                $session = session();
                $session->setFlashData('mensaje','Formato o tamaño de imagen no admitido, el formato debe ser JPG, PNG, JPEG o GIF con tamaño máximo de 2mb');
                return $this->response->redirect(base_url('UsuariosCrear'));
            }
    
            $nuevoNombre=$imagen->getRandomName();
            $ruta = '../public/users/img/';
            $imagen->move($ruta,$nuevoNombre);
            $imagenNombre = $ruta .  $nuevoNombre;
        } else {
            $imagenNombre = null; // Si no se carga imagen, deja el campo "imagen" vacío en la BD
        }
        // Hash la contraseña
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        // Crea el nuevo usuario
        $usuarioNuevo = ['usuario' => $usuario, 'password' => $passwordHash, 'id_persona' => $id_persona, 'id_rol' => $id_rol, 'estado' => $estado, 'imagen' => $imagenNombre];
        $users->guardar($usuarioNuevo);
        return redirect()->to(base_url('usuarios'))->with('mensaje', 'Usuario creado exitosamente');
    }
    
    public function eliminar($id = null) {
        
        $users = new Users();
        $session = session();
        $idUsuario = $session->get('id'); 
        if($idUsuario == $id){
            $session = session();
            $session->setFlashData('mensaje','No se puede eliminar el usuario ya que esta siendo usado en esta sesion');
            return $this->response->redirect(base_url('usuarios'));
        }
        $datos = $users->where('id', $id)->first();
        $users->where('id', $id)->delete($id);
        return redirect()->to(base_url('usuarios'));
    }

    public function editar($id=null){
        $usuario = new Users();
        $data['usuario'] = $usuario->where('id',$id)->first();
        $rol = new Roles();
        $data['roles'] = $rol->orderBy('id','ASC')->findAll();
        $persona = new Personas();
        $data['personas'] = $persona->orderBy('id','ASC')->findAll();
        $titulo = "Usuarios";
        $data['titulo'] = $titulo;
        return view('usuarios/editar', $data);
    }

    public function actualizar(){
        
        $users = new Users();
        $usuario = $this->request->getPost('usuario');
        $id_persona = $this->request->getPost('id_persona');
        $id_rol = $this->request->getPost('id_rol');
        #$imagen = $this->request->getPost('imagen');
        $imagen = $this->request->getFile('imagen');
        $id = $this->request->getPost('id');
        $estado = 1;

        $usuario = $users->ID($id);

        $datos = [
            'usuario' => $usuario,
            'id_persona' => $id_persona,
            'id_rol' => $id_rol,
            'estado' => $estado,
        ];
        
        $existePersona = $users->validarPersona($id_persona);
        if (is_array($existePersona) && count($existePersona) > 0 && $existePersona['id'] != $id) {
            //return redirect()->back()->withInput()->with('mensaje', 'La persona seleccionada ya tiene un usuario creado');
            $session = session();
            $session->setFlashData('mensaje','La persona seleccionada ya tiene un usuario creado');
            return redirect()->back()->withInput();
        }

        $usuarioExistente = $users->obtenerUsuario($usuario);
        if (is_array($usuarioExistente) && count($usuarioExistente) > 0 && $usuarioExistente['id'] != $id) {
            $session = session();
            $session->setFlashData('mensaje', 'Ya existe un usuario con ese nombre');
            return redirect()->back()->withInput();
        }


        $validacion = $this->validate([
            'usuario'=>'required|min_length[6]',
            'id_persona' => 'required|numeric',
            'id_rol' => 'required|numeric'
        ]);
        if(!$validacion){
            $session = session();
            $session->setFlashData('mensaje','Hay campos vacios, por favor completar el formulario');
            return $this->response->redirect(base_url('UsuariosCrear'));
        }

        $validarImagen = $this->validate([
            'imagen' => [
                'if_exist',
                'uploaded_file[imagen]',
                'mime_in[imagen,image/jpg,image/jpeg,image/png]',
                'max_size[imagen,2000]'
            ]
        ]);

        
        $users->update($id,$datos);
        
        if(!$validarImagen){
            $session = session();
            $session->setFlashData('mensaje','Formato o tamaño de imagen no admitido, el formato debe ser JPG, PNG, JPEG o GIF con tamaño máximo de 2mb');
            return $this->response->redirect(base_url('UsuariosCrear'));
        }
        
        if($imagen and $validarImagen and ! $imagen->hasMoved()){
            $nuevoNombre = $imagen->getRandomName();
            $ruta = '../public/users/img/';
            $imagen->move($ruta,$nuevoNombre);
            $imagen = $ruta.$nuevoNombre;
            if(file_exists($ruta.$usuario['imagen'])){
                unlink($ruta.$usuario['imagen']);
            }
        }
        $dataUpdate = ['usuario' => $usuario, 'id_persona' => $id_persona, 'id_rol' => $id_rol, 'estado' => $estado, 'imagen' => $imagenNombre];
        
        $users->update($id,$dataUpdate);
        return $this->response->redirect(site_url('/usuarios'));
    }

   
}