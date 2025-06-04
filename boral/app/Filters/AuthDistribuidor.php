<?php

namespace App\Filters;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthDistribuidor implements FilterInterface
{
    public function before(RequestInterface $request,$arguments=null)
    {
     if(session()->get('role')!="Administrador" && session()->get('role')!="SuperAdmin")
         return redirect()->to('/distribuidores');
     else if(session()->get('role')!="Administrador" && session()->get('role')!="SuperAdmin")  
         return redirect()->to('/distribuidores');
    }
    
    public function after(RequestInterface $request,ResponseInterface $response,$arguments=null)
    {
     
        
         
    }
    
}
