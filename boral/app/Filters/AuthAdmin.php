<?php

namespace App\Filters;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthAdmin implements FilterInterface
{
    public function before(RequestInterface $request,$arguments=null)
    {
     if(session()->get('role')!="Administrador" && session()->get('role')!="Distribuidor" && session()->get('role')!="SuperAdmin")
         return redirect()->to('/');
     else if(session()->get('role')!="Administrador" && session()->get('role')!="Distribuidor" && session()->get('role')!="SuperAdmin")  
         return redirect()->to('/');
    }
    
    public function after(RequestInterface $request,ResponseInterface $response,$arguments=null)
    {
     
        
         
    }
    
}
