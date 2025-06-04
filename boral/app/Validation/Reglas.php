<?php
namespace App\Validation;
use CodeIgniter\I18n\Time;
use App\Models\UsuarioModel;

class Reglas{

 public function fecha_mayor($str,$str2){
        $date1=Time::parse($str,'Europe/Madrid');
        $date2=Time::parse($str2,'Europe/Madrid');
        
        //$diff=$date1->difference($date2);
        
        if($date1>$date2)
            return true;
        else
            return false;
    }
    
    public function validar_cif_nif_nie($str)
    {
        // Definimos el regex para el CIF, NIF o NIE español
        $pattern = '/^([A-Z]{1}[0-9]{7}[A-Z]{1}|[0-9]{8}[A-Z]{1}|[KLM]{1}[0-9]{7}[A-Z]{1}|[XYZ]{1}[0-9]{7}[A-Z]{1})$/';

        // Verificamos si el valor coincide con el patrón
        if (preg_match($pattern, $str)) {
            return true; // Si pasa la validación, devuelve true
        } else {
            return false; // Si no, devuelve false
        }
    }
    
    
    public function canLogin(string $str, string $fields, array $data): bool
    {
        $userModel = new UsuarioModel();
        $user = $userModel->join('roles', 'usuarios.id_roles = roles.id')
            ->select('usuarios.id, usuarios.usuario, usuarios.password, usuarios.email, usuarios.id_roles, roles.role')
            ->where('usuario', $data['username'])
            ->first();

        if (!$user) {
            return false; // El usuario no existe
        }

        // Verificar si la contraseña ingresada coincide con la almacenada (suponiendo que está en MD5)
        if (md5($data['password']) !== $user['password']) {
            return false; // Contraseña incorrecta
        }

        // Comprobar si el rol del usuario es "Administrador", "Distribuidor" o "SuperAdmin"
        if ($user['role'] !== 'Administrador' && $user['role'] !== 'Distribuidor' && $user['role'] !== 'SuperAdmin') {
            return false; // El rol no es válido, acceso denegado
        }

        return true; // El usuario puede iniciar sesión
    }
    
    
    
    public function canLoginUser(string $str, string $fields, array $data): bool
    {
        $userModel = new UsuarioModel();
        $user = $userModel->join('roles', 'usuarios.id_roles = roles.id')
            ->select('usuarios.id, usuarios.usuario, usuarios.password, usuarios.email, usuarios.id_roles, roles.role')
            ->where('usuario', $data['username'])
            ->first();

        if (!$user) {
            return false; // El usuario no existe
        }

        // Verificar si la contraseña ingresada coincide con la almacenada (suponiendo que está en MD5)
        if (md5($data['password']) !== $user['password']) {
            return false; // Contraseña incorrecta
        }


        return true; // El usuario puede iniciar sesión
    }
    
    
    
    public function validar_telefono($str)
{
    // Definimos el regex para validar números de teléfono en España (móviles y fijos)
    $pattern = '/^(6|7|9)[0-9]{8}$/';

    // Verificamos si el valor coincide con el patrón
    if (preg_match($pattern, $str)) {
        return true; // Si pasa la validación, devuelve true
    } else {
        return false; // Si no, devuelve false
    }
}
    
    public function password_check($password,$storedPassword)
{
            if (md5($password)===$storedPassword) {
            return true;
            }
            return false;
}
    
    public function fecha_pedido_no_pasada($fecha_pedido)
{
    // Convertir la fecha ingresada a un formato de fecha
    $fecha_pedido = strtotime($fecha_pedido);
    
        $fech_act=date('Y-m-d');
    // Obtener la fecha actual en formato timestamp
    $fecha_actual = strtotime('-7 day',strtotime($fech_act));

    // Comparar la fecha ingresada con la fecha actual
    if ($fecha_pedido < $fecha_actual) {
        // Si la fecha ingresada es anterior a la actual, retorna false
        return false;
    }

    // Si la fecha es válida (no es anterior al día de hoy), retorna true
    return true;
}


function fecha_pedido_no_pasadaEdit($fecha_nueva, $fecha_antigua)
{
    // Convertir las fechas a timestamp
    $fecha_nueva_timestamp = strtotime($fecha_nueva);
    $fecha_antigua_timestamp = strtotime('-7 day', strtotime($fecha_antigua));
    
    // Verificar si la nueva fecha es mayor o igual a la antigua
    if ($fecha_nueva_timestamp < $fecha_antigua_timestamp) {
        return false; // Si la fecha nueva es anterior a la antigua, retorna false
    }

    return true; // Si la nueva fecha es igual o posterior a la antigua, retorna true
}

    

function comprobar_estado($estadoNuevo,$estadoActual)
{

    // Verificar las restricciones según el estado actual
    if ($estadoActual === 'cancelado' && in_array($estadoNuevo, ['entregado', 'enviado', 'pendiente'])) {
        return false;  // No se puede cambiar a estos estados desde "cancelado"
    }
    if ($estadoActual === 'entregado' && in_array($estadoNuevo, ['enviado', 'pendiente', 'cancelado'])) {
        return false;  // No se puede cambiar a estos estados desde "entregado"
    }
    if ($estadoActual === 'enviado' && $estadoNuevo === 'pendiente') {
        return false;  // No se puede cambiar a "pendiente" desde "enviado"
    }

    // Si todo está bien, se permite el cambio de estado
    return true;
}

    
public function validarProductosDuplicados($str, $productosSeleccionados)
{
    // Convertimos el string de productos seleccionados en un array
    $productosSeleccionados = explode(',', $productosSeleccionados);

    // Verificamos si hay duplicados en el array
    $duplicados = array_count_values($productosSeleccionados);

    // Si algún producto aparece más de una vez, la validación falla
    foreach ($duplicados as $productoId => $cantidad) {
        if ($cantidad > 1) {
            return false; // Si hay un duplicado, retornamos false
        }
    }

    return true; // No hay duplicados
}

     public function correoExistente(string $email)
    {
        $userModel = new UsuarioModel();

        // Comprobar si el correo existe
        $user = $userModel->where('email', $email)->first();

        // Si el correo existe, devuelve true, de lo contrario false
        return $user ? true : false;
    }
    
     public function usuario_valido(string $str)
    {
        // Cargar el modelo de usuario
        $userModel = new UsuarioModel();

        // Comprobar si el nombre de usuario existe en la base de datos
        $user = $userModel->where('usuario', $str)->first();

        if (!$user) {
            return false;
        }

        return true;
    }


    

    
}

?>





