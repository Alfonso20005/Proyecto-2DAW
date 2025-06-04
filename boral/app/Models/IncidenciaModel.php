<?php
namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class IncidenciaModel extends Model
{
    protected $table='incidencias';
    protected $allowedFields=['email', 'descripcion','estado', 'fecha'];
}
?>