
<?php include("templates/parte1.php");?>
<title>Boral | Proveedores Edit</title>
<div class="row">
    
    <div class="col-12 d-flex justify-content-between align-items-center">
        <h1 class="text-primary font-weight-bold">EDITAR PROVEEDOR</h1>

        <!-- Botón Volver -->
        <a href="<?php echo baseUrl();?>/proveedores/volver" class="btn btn-secondary"><i class="fa-solid fa-arrow-left"></i>&nbsp; Volver</a>
    </div>
    
    <div class="col-12">
             <?php   validation_list_errors();
                    $errors=validation_errors();
            ?>
        
        <form action="<?php echo baseUrl();?>/proveedores/actualizar" method="post" enctype="multipart/form-data" id="form1">
            <input type="hidden" name="id" id="id" value="<?= $datos["id"];?>">
            
                <div class="row mb-3">
            <div class="mb-3 col-md-4">
                <label for="razon_social" class="form-label">Razon Social</label>
                <div class="input-group">
                    <div class="input-group-prepend <?php echo isset($errors["razon_social"]) ? 'is-invalid border border-danger' : ''; ?>">
                        <span class="input-group-text"><i class="fa-solid fa-briefcase"></i></span>
                    </div>
                     <input type="text" class="form-control <?php echo isset($errors["razon_social"]) ? 'is-invalid border border-danger' : ''; ?>" id="razon_social" name="razon_social" placeholder="Razon Social" value="<?=rellenarDato($errors,$datos,"razon_social");?>">
                </div>
                <?php
                    if(isset($errors["razon_social"])) echo validation_show_error('razon_social');  
                ?>

            </div>
            
             <div class="mb-3 col-md-4">
                <label for="nombre" class="form-label">Nombre</label>
                 <div class="input-group">
                    <div class="input-group-prepend <?php echo isset($errors["nombre"]) ? 'is-invalid border border-danger' : ''; ?>">
                        <span class="input-group-text"><i class="fa fa-users"></i></span>
                    </div>
                    <input type="text" class="form-control <?php echo isset($errors["nombre"]) ? 'is-invalid border border-danger' : ''; ?>" id="nombre" name="nombre" placeholder="Nombre" value="<?=rellenarDato($errors,$datos,"nombre");?>">
                 </div>
                <?php
                    if(isset($errors["nombre"])) echo validation_show_error('nombre');  
                ?>

            </div>


            <div class="mb-3 col-md-4">
                <label for="apellidos" class="form-label">Apellidos</label>
                <div class="input-group">
                    <div class="input-group-prepend <?php echo isset($errors["apellidos"]) ? 'is-invalid border border-danger' : ''; ?>">
                        <span class="input-group-text"><i class="fa fa-users"></i></span>
                    </div>
                    <input type="text" class="form-control <?php echo isset($errors["apellidos"]) ? 'is-invalid border border-danger' : ''; ?>" id="apellidos" name="apellidos" placeholder="Apellidos" value="<?=rellenarDato($errors,$datos,"apellidos");?>">
                </div>
                <?php
                    if(isset($errors["apellidos"])) echo validation_show_error('apellidos');  
                ?>
            </div>


            <div class="mb-3 col-md-4">
                <label for="telefono" class="form-label">Telefono</label>
                <div class="input-group">
                    <div class="input-group-prepend <?php echo isset($errors["telefono"]) ? 'is-invalid border border-danger' : ''; ?>">
                        <span class="input-group-text"><i class="fa-solid fa-phone"></i></span>
                    </div>
                    <input type="text" class="form-control <?php echo isset($errors["telefono"]) ? 'is-invalid border border-danger' : ''; ?>" id="telefono" name="telefono" placeholder="Telefono" value="<?=rellenarDato($errors,$datos,"telefono");?>">
                </div>
                <?php
                    if(isset($errors["telefono"])) echo validation_show_error('telefono');  
                ?>
            </div>
            
            <div class="mb-3 col-md-4">
                <label for="cif_nif_nie" class="form-label">Cif/Nif/Nie</label>
                <div class="input-group">
                    <div class="input-group-prepend <?php echo isset($errors["cif_nif_nie"]) ? 'is-invalid border border-danger' : ''; ?>">
                        <span class="input-group-text"><i class="fa-solid fa-passport"></i></span>
                    </div>
                    <input type="text" class="form-control <?php echo isset($errors["cif_nif_nie"]) ? 'is-invalid border border-danger' : ''; ?>" id="cif_nif_nie" name="cif_nif_nie" placeholder="Cif/Nif/Nie" value="<?=rellenarDato($errors,$datos,"cif_nif_nie");?>">
                </div>
                <?php
                    if(isset($errors["cif_nif_nie"])) echo validation_show_error('cif_nif_nie');  
                ?>
            </div>
            
            <div class="col-md-4 mb-3">
                <label for="email" class="form-label">Email</label>
                <div class="input-group">
                    <div class="input-group-prepend <?php echo isset($errors["email"]) ? 'is-invalid border border-danger' : ''; ?>">
                        <span class="input-group-text"><i class="far fa-envelope"></i></span>
                    </div>
                    <input type="text" class="form-control <?php echo isset($errors["email"]) ? 'is-invalid border border-danger' : ''; ?>" id="email" name="email" placeholder="Email" value="<?=rellenarDato($errors,$datos,"email");?>">
                </div>
                <?php
                    if(isset($errors["email"])) echo validation_show_error('email');  
                ?>
            </div>
            
            
           <input type="hidden" id="latitud" name="latitud" value="<?= old('latitud', isset($datos['latitud']) ? $datos['latitud'] : '41.64882234'); ?>">
           <input type="hidden" id="longitud" name="longitud" value="<?= old('longitud', isset($datos['longitud']) ? $datos['longitud'] : '-0.88908423'); ?>">




            
            <div class="col-md-12 mb-3">
                <label for="direccion" class="form-label">Direccion</label>
                <div class="input-group">
                    <div class="input-group-prepend <?php echo isset($errors["direccion"]) ? 'is-invalid border border-danger' : ''; ?>">
                        <span class="input-group-text"><i class="fa-solid fa-location-dot"></i></span>
                    </div>
                    <input type="text" class="form-control <?php echo isset($errors["direccion"]) ? 'is-invalid border border-danger' : ''; ?>" id="direccion" name="direccion" placeholder="Direccion" value="<?=rellenarDato($errors,$datos,"direccion");?>">
                </div>
                <?php
                    if(isset($errors["direccion"])) echo validation_show_error('direccion');  
                ?>
            </div>
            
            <div id="map-container">
                <div id="map" ></div> 
            </div>
            
        </div>

                    <div class="mb-3"> 
                        <input type="submit" class="btn btn-primary w-100" value="Aceptar" id="btnform11">
                    </div>

        </form>
        
    </div>
</div>
<?php include("templates/parte2.php");?>

<script>
let map;
let marcador;

// Obtener valores de latitud y longitud, priorizando lo ingresado por el usuario
const latitudInput = document.getElementById("latitud");
const longitudInput = document.getElementById("longitud");
const direccionInput = document.getElementById("direccion");

let latitud = parseFloat(latitudInput.value) || 41.6488;
let longitud = parseFloat(longitudInput.value) || -0.8891;
let direccionBD = direccionInput.value.trim();

// Función para inicializar el mapa con los valores guardados o editados
function inicializarMapa() {
    map = L.map('map').setView([latitud, longitud], 16); 

    const styles = ['jawg-streets', 'jawg-dark'];
    const accessToken = '7vzJSH3HGygeDfysqWtTMmEX1SzE9ezgXWkDrJtyOdyOCc9tTT1dCbwFtjeBAF4I';
    const baselayers = {};

    styles.forEach((style) => {
        baselayers[style] = L.tileLayer(
            `https://tile.jawg.io/${style}/{z}/{x}/{y}.png?access-token=${accessToken}`, {
                attribution: '<a href="https://jawg.io" title="Tiles Courtesy of Jawg Maps" target="_blank" class="jawg-attrib">&copy; <b>Jawg</b>Maps</a>',
            }
        );
    });

    baselayers['jawg-streets'].addTo(map);
    L.control.layers(baselayers).addTo(map);

    // Agregar marcador con los valores actuales
    marcador = L.marker([latitud, longitud])
        .addTo(map)
        .bindPopup(`Ubicación: ${direccionBD ? direccionBD : "Desconocida"}`)
        .openPopup();
}

// Función para actualizar la latitud y longitud cuando el usuario ingresa una nueva dirección
function obtenerUbicacionPorDireccion(direccion) {
    fetch(`https://nominatim.openstreetmap.org/search?q=${encodeURIComponent(direccion)}, Zaragoza&format=json`)
        .then(response => response.json())
        .then(data => {
            if (data.length > 0) {
                const nuevaLatitud = parseFloat(data[0].lat);
                const nuevaLongitud = parseFloat(data[0].lon);

                // Guardar los nuevos valores en los inputs ocultos
                latitudInput.value = nuevaLatitud;
                longitudInput.value = nuevaLongitud;

                // Actualizar el mapa y el marcador
                map.setView([nuevaLatitud, nuevaLongitud], 16);
                if (marcador) {
                    map.removeLayer(marcador);
                }
                marcador = L.marker([nuevaLatitud, nuevaLongitud])
                    .addTo(map)
                    .bindPopup(`Ubicación: ${direccion}`)
                    .openPopup();
            } else {
                alert("Dirección no encontrada. Se mantiene la ubicación anterior.");
            }
        })
        .catch(error => {
            console.error("Error al obtener la ubicación:", error);
        });
}

// Evento que actualiza la ubicación cuando el usuario edita la dirección
direccionInput.addEventListener("blur", () => {
    const direccion = direccionInput.value.trim();
    if (direccion) {
        obtenerUbicacionPorDireccion(direccion);
    }
});

// Inicializar el mapa con la última ubicación ingresada o guardada
document.addEventListener("DOMContentLoaded", inicializarMapa);
</script>

