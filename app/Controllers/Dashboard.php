<?php

namespace App\Controllers;
use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index()
    { 
<<<<<<< HEAD
=======
        if ($this->validarSesion()) {
            return redirect()->to(base_url(''));
        }
>>>>>>> d1476fef7db13c36fbe91007409866aadda36ff2
        $titulo = "Dashboard";
        return view('Dashboard/index',['titulo' => $titulo]);
    }
}
