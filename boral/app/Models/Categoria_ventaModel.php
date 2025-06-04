<?php
namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class Categoria_ventaModel extends Model
{
    protected $table='categorias_venta';
    protected $allowedFields=['nombre'];
    
}
?>