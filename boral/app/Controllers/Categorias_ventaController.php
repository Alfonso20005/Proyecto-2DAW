<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\Categoria_ventaModel;


class Categorias_ventaController extends BaseController
{
    
     protected $helpers=['form'];
    public function index()
    {
        $model=new Categoria_ventaModel();
        $data['categorias']=$model->findAll();
        
        return view('categorias_ventaListView',$data);
    }
    
    public function nuevo()
    {
        
        return view('categorias_ventaNewView');
    }
    
    
     public function crear()
    {
       
         $rules=[
         'nombre'=>[
             'rules'=>'required|is_unique[categorias_venta.nombre]',
             'errors'=>[
                 'required'=>'Debes introducir una categoria',
                 'is_unique'=>'El nombre de la categoria ya existe',
             ]
         ],
           
      
       ]; 
        
      $datos=$this->request->getPost(array_keys($rules));
    
     if(!$this->validateData($datos,$rules)){
         return redirect()->back()->withInput();
     }     
         
        $model=new Categoria_ventaModel();
        $nombre=$this->request->getvar('nombre');
         
         $newData=[
             'nombre'=>$nombre
         ];
         
         $model->save($newData);
         
         
          return redirect()->to('/categorias_venta');
    }
    
    public function editar()
    {
        $model=new Categoria_ventaModel();
        $id=$this->request->getvar('id');
        $data["datos"]=$model->where('id',$id)->first();
        
        return view('categorias_ventaEditView',$data);
    }
    
    public function actualizar()
    {
       $id=$this->request->getvar('id');
         $rules=[
         'nombre'=>[
             'rules'=>'required|is_unique[categorias_venta.nombre,id,'.$id.']',
             'errors'=>[
                 'required'=>'Debes introducir una categoria',
                 'is_unique'=>'El nombre de la categoria ya existe',
               
             ]
         ],
           
      
       ]; 
        
      $datos=$this->request->getPost(array_keys($rules));
    
     if(!$this->validateData($datos,$rules)){
         return redirect()->back()->withInput();
     }     
         
        $model=new Categoria_ventaModel();
        $nombre=$this->request->getvar('nombre');
        
        $model->where('id',$id)
            ->set(['nombre'=>$nombre])
            ->update();
         
         
          return redirect()->to('/categorias_venta');
    }
   
    
     public function delete()
    {
         
         $model=new Categoria_ventaModel();
        $id=$this->request->getvar('id');
       
       if($model->where('id', $id)->delete()) echo 1;
         else echo 0;
         
    }
    
    public function volver()
    {
        return redirect()->to('/categorias_venta');
    }
}
