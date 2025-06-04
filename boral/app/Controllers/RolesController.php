<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\RoleModel;


class RolesController extends BaseController
{
    
     protected $helpers=['form'];
    public function index()
    {
        $model=new RoleModel();
        $data['roles']=$model->findAll();
        
        return view('rolesListView',$data);
    }
    
    public function nuevo()
    {
        
        return view('rolesNewView');
    }
    
    
     public function crear()
    {
       
         $rules=[
         'role'=>[
             'rules'=>'required|is_unique[roles.role]',
             'errors'=>[
                 'required'=>'Debes introducir un role',
                 'is_unique'=>'El nombre del role ya existe',
             ]
         ],
           
      
       ]; 
        
      $datos=$this->request->getPost(array_keys($rules));
    
     if(!$this->validateData($datos,$rules)){
         return redirect()->back()->withInput();
     }     
         
        $model=new RoleModel();
        $role=$this->request->getvar('role');
         
         $newData=[
             'role'=>$role
         ];
         
         $model->save($newData);
         
         
          return redirect()->to('/roles');
    }
    
    public function editar()
    {
        $model=new RoleModel();
        $id=$this->request->getvar('id');
        $data["datos"]=$model->where('id',$id)->first();
        
        return view('rolesEditView',$data);
    }
    
    public function actualizar()
    {
       $id=$this->request->getvar('id');
         $rules=[
         'role'=>[
             'rules'=>'required|is_unique[roles.role,id,'.$id.']',
             'errors'=>[
                 'required'=>'Debes introducir un role',
                 'is_unique'=>'El nombre del role ya existe',
               
             ]
         ],
           
      
       ]; 
        
      $datos=$this->request->getPost(array_keys($rules));
    
     if(!$this->validateData($datos,$rules)){
         return redirect()->back()->withInput();
     }     
         
        $model=new RoleModel();
        $role=$this->request->getvar('role');
        
        $model->where('id',$id)
            ->set(['role'=>$role])
            ->update();
         
         
          return redirect()->to('/roles');
    }
   
    
     public function delete()
    {
         
         $model=new RoleModel();
        $id=$this->request->getvar('id');
       
       if($model->where('id', $id)->delete()) echo 1;
         else echo 0;
         
    }
    
    public function volver()
    {
        return redirect()->to('/roles');
    }
}
