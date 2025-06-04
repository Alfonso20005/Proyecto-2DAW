<?php

namespace App\Controllers;

use App\Models\RoleModel;
use App\Models\UsuarioModel;


class Dashboard extends BaseController
{
    protected $helpers=['form'];
    public function index()
    {
        return view('inicio1');
    }
     public function login()
    {
        return view('loginUserView');
    }

}
