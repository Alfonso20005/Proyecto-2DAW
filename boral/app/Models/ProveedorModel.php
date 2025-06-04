<?php
namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class ProveedorModel extends Model
{
//    SELECT `id`, `razon_social`, `nombre`, `apellidos`, `cif_nif_nie`, `telefono`, `email`, `direccion` FROM `proveedores` WHERE 1
    protected $table='proveedores';
    protected $allowedFields=['razon_social','nombre','apellidos','cif_nif_nie','telefono','email','direccion','latitud','longitud'];
    
}
?>