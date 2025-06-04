<?php include("templates/parte1.php");?>
<title>Boral | Proveedores New</title>
<div class="row">
    <div class="col-12 d-flex justify-content-between align-items-center">
        <h1 class="text-primary font-weight-bold">CREAR PROVEEDOR</h1>

        <!-- Botón Volver -->
        <a href="<?php echo baseUrl();?>/proveedores/volver" class="btn btn-secondary"><i class="fa-solid fa-arrow-left"></i>&nbsp; Volver</a>
    </div>

    <div class="col-12">

        <?php validation_list_errors(); $errors=validation_errors(); ?>

        <form action="<?php echo baseUrl();?>/proveedores/crear" method="post" enctype="multipart/form-data" id="form1">

            
        <div class="row mb-3">
            <div class="mb-3 col-md-4">
                <label for="razon_social" class="form-label">Razon Social</label>
                <div class="input-group">
                    <div class="input-group-prepend <?php echo isset($errors["razon_social"]) ? 'is-invalid border border-danger' : ''; ?>">
                        <span class="input-group-text"><i class="fa-solid fa-briefcase"></i></span>
                    </div>
                     <input type="text" class="form-control <?php echo isset($errors["razon_social"]) ? 'is-invalid border border-danger' : ''; ?>" id="razon_social" name="razon_social" placeholder="Razon Social" value="<?= set_value('razon_social');?>">
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
                    <input type="text" class="form-control <?php echo isset($errors["nombre"]) ? 'is-invalid border border-danger' : ''; ?>" id="nombre" name="nombre" placeholder="Nombre" value="<?= set_value('nombre');?>">
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
                    <input type="text" class="form-control <?php echo isset($errors["apellidos"]) ? 'is-invalid border border-danger' : ''; ?>" id="apellidos" name="apellidos" placeholder="Apellidos" value="<?= set_value('apellidos');?>">
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
                    <input type="text" class="form-control <?php echo isset($errors["telefono"]) ? 'is-invalid border border-danger' : ''; ?>" id="telefono" name="telefono" placeholder="Telefono" value="<?= set_value('telefono');?>">
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
                    <input type="text" class="form-control <?php echo isset($errors["cif_nif_nie"]) ? 'is-invalid border border-danger' : ''; ?>" id="cif_nif_nie" name="cif_nif_nie" placeholder="Cif/Nif/Nie" value="<?= set_value('cif_nif_nie');?>">
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
                    <input type="text" class="form-control <?php echo isset($errors["email"]) ? 'is-invalid border border-danger' : ''; ?>" id="email" name="email" placeholder="Email" value="<?= set_value('email');?>">
                </div>
                <?php
                    if(isset($errors["email"])) echo validation_show_error('email');  
                ?>
            </div>
            
            
            <input type="hidden" id="latitud" name="latitud" value="<?= old('latitud', '41.64882234'); ?>">
            <input type="hidden" id="longitud" name="longitud" value="<?= old('longitud', '-0.88908423'); ?>">


            
            <div class="col-md-12 mb-3">
                <label for="direccion" class="form-label">Direccion</label>
                <div class="input-group">
                    <div class="input-group-prepend <?php echo isset($errors["direccion"]) ? 'is-invalid border border-danger' : ''; ?>">
                        <span class="input-group-text"><i class="fa-solid fa-location-dot"></i></span>
                    </div>
                    <input type="text" class="form-control <?php echo isset($errors["direccion"]) ? 'is-invalid border border-danger' : ''; ?>" id="direccion" name="direccion" placeholder="Direccion" value="<?= set_value('direccion');?>">
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

// Función para inicializar el mapa con Zaragoza por defecto o la última ubicación guardada
function inicializarMapa() {
    let latitud = parseFloat(document.getElementById("latitud").value);
    let longitud = parseFloat(document.getElementById("longitud").value);

    // Si no hay una ubicación guardada, usar Zaragoza como predeterminada
    if (isNaN(latitud) || isNaN(longitud)) {
        latitud = 41.6488; // Zaragoza
        longitud = -0.8891;
    }

    // Inicializar el mapa con la última ubicación registrada
    map = L.map('map').setView([latitud, longitud], 15); // Zoom ajustado a 15

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

    // Agregar marcador con la última ubicación guardada
    marcador = L.marker([latitud, longitud])
        .addTo(map)
        .bindPopup("Ubicación seleccionada")
        .openPopup();
}

// Función para actualizar la ubicación en el mapa y guardar valores en los campos ocultos
function actualizarUbicacion(latitud, longitud, direccion) {
    document.getElementById("latitud").value = latitud;
    document.getElementById("longitud").value = longitud;

    // Mover el mapa a la nueva ubicación con zoom 16
    map.setView([latitud, longitud], 16);

    // Si ya hay un marcador, eliminarlo antes de agregar el nuevo
    if (marcador) {
        map.removeLayer(marcador);
    }

    // Agregar nuevo marcador en la ubicación seleccionada
    marcador = L.marker([latitud, longitud])
        .addTo(map)
        .bindPopup(`Ubicación: ${direccion}`)
        .openPopup();
}

// Función que obtiene la latitud y longitud de una dirección ingresada por el usuario
function obtenerUbicacionPorDireccion(direccion) {
   fetch(`https://nominatim.openstreetmap.org/search?q=${encodeURIComponent(direccion)}, Zaragoza&format=json`)
        .then(response => response.json())
        .then(data => {
            let latitud, longitud;

            if (data.length > 0) {
                // Si se encontró una ubicación, la usamos
                latitud = parseFloat(data[0].lat);
                longitud = parseFloat(data[0].lon);
                console.log("Ubicación encontrada:", latitud, longitud);
            } else {
                // Si no se encuentra la dirección, volvemos a Zaragoza
                console.log("No se encontró la ubicación. Usando Zaragoza por defecto.");
                latitud = 41.6488;
                longitud = -0.8891;
            }

            // Actualizar el mapa y guardar valores
            actualizarUbicacion(latitud, longitud, direccion);
        })
        .catch(error => {
            console.error("Error al obtener la ubicación:", error);
            alert("No se pudo obtener la ubicación. Intenta nuevamente.");
        });
}

// Evento cuando el usuario deja de escribir en el input de dirección
document.getElementById("direccion").addEventListener("blur", () => {
    const direccion = document.getElementById("direccion").value.trim();
    if (direccion) {
        obtenerUbicacionPorDireccion(direccion);
    }
});

// Mantener ubicación tras validación del formulario
document.addEventListener('DOMContentLoaded', () => {
    inicializarMapa();

    // Recuperar la última ubicación guardada en los campos ocultos
    let latitud = parseFloat(document.getElementById("latitud").value);
    let longitud = parseFloat(document.getElementById("longitud").value);
    let direccion = document.getElementById("direccion").value.trim() || "Zaragoza";

    if (!isNaN(latitud) && !isNaN(longitud)) {
        actualizarUbicacion(latitud, longitud, direccion);
    }
});


</script>

