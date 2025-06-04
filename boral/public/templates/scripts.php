  <!-- Vendor js -->


        <script src="<?php echo baseUrl();?>/templates/assets/js/vendor.min.js"></script>

        <script src="<?php echo baseUrl();?>/templates/assets/libs/morris-js/morris.min.js"></script>
        <script src="<?php echo baseUrl();?>/templates/assets/libs/raphael/raphael.min.js"></script>

        <script src="<?php echo baseUrl();?>/templates/assets/js/pages/dashboard.init.js"></script>

        <!-- App js -->
        <script src="<?php echo baseUrl();?>/templates/assets/js/app.min.js"></script>

<script src="<?php echo baseUrl();?>/templates/assets/libs/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo baseUrl();?>/node_modules/sweetalert2/dist/sweetalert2.min.js"></script>

  

        <script src="<?php echo baseUrl();?>/assets/libs/flot-charts/jquery.flot.js"></script>
        <script src="<?php echo baseUrl();?>/assets/libs/flot-charts/jquery.flot.time.js"></script>
        <script src="<?php echo baseUrl();?>/assets/libs/flot-charts/jquery.flot.tooltip.min.js"></script>
        <script src="<?php echo baseUrl();?>/assets/libs/flot-charts/jquery.flot.resize.js"></script>
        <script src="<?php echo baseUrl();?>/assets/libs/flot-charts/jquery.flot.pie.js"></script>
        <script src="<?php echo baseUrl();?>/assets/libs/flot-charts/jquery.flot.selection.js"></script>
        <script src="<?php echo baseUrl();?>/assets/libs/flot-charts/jquery.flot.stack.js"></script>
        <script src="<?php echo baseUrl();?>/assets/libs/flot-charts/jquery.flot.orderBars.js"></script>
        <script src="<?php echo baseUrl();?>/assets/libs/flot-charts/jquery.flot.crosshair.js"></script>
        <script src="<?php echo baseUrl();?>/assets/libs/flot-charts/jquery.flot.axislabels.js"></script>
  <!-- Chart JS -->
        <script src="<?php echo baseUrl();?>/assets/libs/chart-js/Chart.bundle.min.js"></script>
<script src="<?php echo baseUrl();?>/tinymce_7.5.0/tinymce/js/tinymce/tinymce.min.js"></script>

<script src="<?php echo baseUrl();?>/assets/libs/select2/js/select2.min.js"></script>
<script src="<?php echo baseUrl();?>/templates/assets/js/dataTables.bootstrap5.min.js"></script>

<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>


 <!-- Google Charts js -->
   <script src="https://www.gstatic.com/charts/loader.js"></script>


<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>


<!-- Switchery JS -->
<!--<script src="https://cdn.jsdelivr.net/npm/switchery@0.8.2/dist/switchery.min.js"></script>-->
<script>
$( document ).ready(function() {
   $(".datatable").DataTable();
    $(".select2").select2({
        theme:'bootstrap-5'
    });
});
    
    
    
// Acción de logout con confirmación
$(".logout").click(function() {
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-success ml-3",
            cancelButton: "btn btn-danger"
        },
        buttonsStyling: false
    });

    swalWithBootstrapButtons.fire({
        title: "¿Estás seguro de que deseas cerrar sesión?",
        text: "Perderás tu sesión actual.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Sí, salir",
        cancelButtonText: "No, mantenerme conectado",
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            // Eliminar el tiempo de inicio de sesión del localStorage
                localStorage.removeItem("sessionStartTime");

             swalWithBootstrapButtons.fire({
                    title: "Cerrado!",
                    text: "Has cerrado sesison con exito",
                    icon: "success",
                    showConfirmButton: false
            });
           setTimeout(function() {
                window.location.href = "<?php echo baseUrl();?>/salir";
            }, 1000);
        }
    });
});
    
    
$(".abrir_temporizador").click(function() {
    let sessionStartTime = localStorage.getItem("sessionStartTime");
    if (sessionStartTime) {
        // Funcion para actualizar el temporizador
        const updateTime = () => {
            // Calculo el tiempo transcurrido en segundos
            let tiempo = Math.floor((new Date() - new Date(sessionStartTime)) / 1000); 
            let horas = Math.floor(tiempo / 3600); 
            let minutos = Math.floor((tiempo % 3600) / 60); 
            let segundos = tiempo % 60; 

           
            let tiempoTranscurrido = `Sesión activa desde hace: ${horas}h ${minutos}m ${segundos}s`;

            // Actualizo el contenido del SweetAlert
            Swal.update({
                text: tiempoTranscurrido 
            });
        };

        Swal.fire({
            title: 'Tiempo de sesión',
            text: '', // Texto vacio porque luego lo actualizo
            icon: 'info',
            confirmButtonText: 'Cerrar',
            background: '#fff',
            showCloseButton: true,
            allowOutsideClick: true,
            didOpen: () => {
                //Para actualizar el tiempo del popup
                this.timerInterval = setInterval(updateTime, 1000);
            },
            willClose: () => {
                // Limpio el tiempo cuando cierro el sweet
                clearInterval(this.timerInterval);
            }
        });
    }
});

   function pedirContrasenaGuardar() {
        Swal.fire({
            title: 'Introduce tu contraseña',
            input: 'password',
            inputLabel: 'Contraseña',
            inputPlaceholder: 'Ingresa tu contraseña',
            showCancelButton: true,
            confirmButtonText: 'Aceptar',
            cancelButtonText: 'Cancelar',
            inputValidator: (value) => {
                if (!value) {
                    return '¡La contraseña es obligatoria!';
                }
            }
        }).then((result) => {
            if (result.isConfirmed) {
                // Obtener la contraseña ingresada
                var password = result.value;

                $.ajax({
                    url: '<?php echo baseUrl(); ?>/perfilUser/verificarContrasena',  // URL del endpoint de verificación
                    method: 'POST',
                    data: {
                        password: password  // Enviar la contraseña ingresada
                    },
                    success: function(response) {
                        // Si la contraseña es correcta, enviamos el formulario
                        if (response.success) {

                            Swal.fire({
                                icon: 'success',
                                title: 'Contraseña correcta',
                                text: 'La contraseña es correcta.'
                            });
                            
                            setTimeout(function() {
                                 document.getElementById("form1").submit();
                            }, 1000);
                            
                           
                        } else {
                            // Si la contraseña es incorrecta, mostrar un mensaje de error
                            Swal.fire({
                                icon: 'error',
                                title: 'Contraseña incorrecta',
                                text: 'La contraseña que has ingresado no es correcta. Inténtalo de nuevo.'
                            });
                        }
                    },
                    error: function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Hubo un error al verificar la contraseña. Inténtalo nuevamente.'
                        });
                    }
                });
            }
        });
}


    
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
tooltipTriggerList.forEach(function (tooltipTriggerEl) {
  new bootstrap.Tooltip(tooltipTriggerEl)
})   

</script>


