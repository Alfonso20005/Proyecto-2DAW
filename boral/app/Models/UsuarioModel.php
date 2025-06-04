<?php
namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class UsuarioModel extends Model
{
    //SELECT `id`, `id_roles`, `usuario`, `password`, `email`, `created_at`, `updated_at` FROM `usuarios` WHERE 1
    protected $table='usuarios';
    protected $allowedFields=['id_roles','usuario','password','email','imagen', 'created_at', 'updated_at'];


    public function datosgrafica(){
        //SELECT `id`, `id_roles`, `usuario`, `password`, `email`, `created_at`, `updated_at` FROM `usuarios` WHERE 1

        //SELECT `id`, `role`, `created_at`, `updated_at` FROM `roles` WHERE 1
        $sql=" SELECT  roles.role, COUNT(usuarios.id_roles) as numUsuarios FROM `usuarios`";
        $sql.=" INNER JOIN roles ON  usuarios.id_roles=roles.id";
        $sql.=" GROUP BY (usuarios.id_roles)";
        $sql.=" ORDER BY (roles.id) asc";

        $query=$this->query($sql);
        $datos=array();

        if($query->getResult()){
            $datos=$query->getResultArray();
        }

        return $datos;

    }
    
    
    public function contarUsuariosTotales()
{
    $sql = "SELECT COUNT(*) AS total_usuarios FROM usuarios";
    
    $query = $this->query($sql);
    $resultado = $query->getRow();  // Obtener una sola fila del resultado
    
    return $resultado ? $resultado->total_usuarios : 0;  // Retornar el total de usuarios
}
    
    public function contarUsuariosHoy()
    {
        $sql = "SELECT COUNT(*) AS usuarios_hoy FROM usuarios WHERE DATE(created_at) = CURDATE()";
        
        $query = $this->query($sql);
        $resultado = $query->getRow();  // Obtener una sola fila del resultado
        
        return $resultado ? $resultado->usuarios_hoy : 0;  // Retornar el número de usuarios registrados hoy
    }

    
    public function obtenerNombreRol() {
    // Construcción de la consulta para obtener el nombre del rol
    $sql = "SELECT roles.role as role, usuarios.* 
            FROM usuarios 
            INNER JOIN roles ON usuarios.id_roles = roles.id ";
    
   $query=$this->query($sql);
        $datos=array();

        if($query->getResult())
            $datos = $query->getResultArray();

        return $datos;
}

    public function encontrarUserDistribuidor(){
    // La consulta ahora excluye a los usuarios con el rol de Administrador o SuperAdmin
    $sql = "SELECT *";
    $sql .= " FROM usuarios";
    $sql .= " WHERE id NOT IN (SELECT id_usuarios FROM distribuidores)";
    $sql .= " AND id_roles NOT IN (1, 2)";  // 1 es el rol de Administrador, 2 es el rol de SuperAdmin
    $sql .= " ORDER BY usuarios.usuario ASC";

    $query = $this->query($sql);
    $datos = array();

    if ($query->getResult()) {
        $datos = $query->getResultArray();
    }

    return $datos;
}

     public function encontrarUserDistribuidor1($idSeleccionado){
            //SELECT `id`, `id_roles`, `usuario`, `password`, `email`, `created_at`, `updated_at` FROM `usuarios` WHERE 1

            //SELECT `id`, `role`, `created_at`, `updated_at` FROM `roles` WHERE 1
            $sql = "SELECT *";
            $sql .= " FROM usuarios";
            $sql .= " WHERE id NOT IN (SELECT id_usuarios FROM distribuidores)";
             $sql .= " OR id = $idSeleccionado";  // Esto asegura que el usuario con el id seleccionado esté incluido
            $sql .= " ORDER BY (usuarios.usuario) ASC";

            $query=$this->query($sql);
            $datos=array();

            if($query->getResult())
                $datos = $query->getResultArray();

            return $datos;

        }

}
?>