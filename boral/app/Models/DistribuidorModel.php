<?php
namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class DistribuidorModel extends Model
{
//    SELECT `id`, `razon_social`, `nombre`, `apellidos`, `cif_nif_nie`, `telefono`, `id_usuarios` FROM `distribuidores` WHERE 1
    protected $table='distribuidores';
    protected $allowedFields=['razon_social','nombre','apellidos','cif_nif_nie','telefono','id_usuarios','created_at', 'updated_at'];
    
}
?>