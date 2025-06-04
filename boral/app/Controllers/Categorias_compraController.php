<?php

namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\Categoria_compraModel;


class Categorias_compraController extends BaseController
{
    
     protected $helpers=['form'];
    public function index()
    {
        $model=new Categoria_compraModel();
        $data['categorias']=$model->findAll();
        
        return view('categorias_compraListView',$data);
    }
    
    public function nuevo()
    {
        
        return view('categorias_compraNewView');
    }
    
    
     public function crear()
    {
       
         $rules=[
         'nombre'=>[
             'rules'=>'required|is_unique[categorias_compra.nombre]',
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
         
        $model=new Categoria_compraModel();
        $nombre=$this->request->getvar('nombre');
         
         $newData=[
             'nombre'=>$nombre
         ];
         
         $model->save($newData);
         
         
          return redirect()->to('/categorias_compra');
    }
    
    public function editar()
    {
        $model=new Categoria_compraModel();
        $id=$this->request->getvar('id');
        $data["datos"]=$model->where('id',$id)->first();
        
        return view('categorias_compraEditView',$data);
    }
    
    public function actualizar()
    {
       $id=$this->request->getvar('id');
         $rules=[
         'nombre'=>[
             'rules'=>'required|is_unique[categorias_compra.nombre,id,'.$id.']',
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
         
        $model=new Categoria_compraModel();
        $nombre=$this->request->getvar('nombre');
        
        $model->where('id',$id)
            ->set(['nombre'=>$nombre])
            ->update();
         
         
          return redirect()->to('/categorias_compra');
    }
   
    
     public function delete()
    {
         
         $model=new Categoria_compraModel();
        $id=$this->request->getvar('id');
       
       if($model->where('id', $id)->delete()) echo 1;
         else echo 0;
         
    }
    
    public function volver()
    {
        return redirect()->to('/categorias_compra');
    }
}
