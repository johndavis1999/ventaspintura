<?php 
namespace App\Models;

use CodeIgniter\Model;

class Users extends Model{
    protected $table      = 'usuarios';
    // Uncomment below if you want add primary key
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_persona','usuario', 'password','id_rol','estado','imagen'];
<<<<<<< HEAD

    /*public function iD($id)
    {
        $this->select("*");
        return $this->where('id',$id)->first();
    }*/
=======
>>>>>>> d1476fef7db13c36fbe91007409866aadda36ff2
    

    public function obtenerUsuario($usuario)
    {
        $query = $this->select('*')->where('usuario', $usuario)->get();
        return $query->getRowArray();
    }

    public function validarPersona($id_persona)
    {
        $query = $this->select('*')->where('id_persona', $id_persona)->get();
        return $query->getRowArray();
    }
    
    public function guardar($data){
        $builder = $this->db->table('usuarios');
        return $builder->insert($data);
    }
}