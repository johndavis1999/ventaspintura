<?php

namespace App\Controllers;
use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index()
    { 
        if ($this->validarSesion()) {
            return redirect()->to(base_url(''));
        }
        $titulo = "Dashboard";
        return view('Dashboard/index',['titulo' => $titulo]);
    }
}
