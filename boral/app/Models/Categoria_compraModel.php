<?php
namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class Categoria_compraModel extends Model
{
    protected $table='categorias_compra';
    protected $allowedFields=['nombre'];
    
}
?>