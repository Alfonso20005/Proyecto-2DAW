<?php include("templates/parte1.php"); ?>
<title>Boral | Factura</title>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
            <?php validation_list_errors(); 
                $errors = validation_errors();
            ?>

            <p class="display-4 text-center text-primary font-weight-bold mb-4">FACTURA</p>

            <div class="card shadow-lg border-light rounded-4">
                <div class="card-body p-4">

                    <form action="<?= baseUrl();?>/facturas/generar" method="post">
                        <?php if (session()->get('role') != 'Distribuidor'): ?>
                            <div class="mb-3">
                                <label for="id_distribuidores" class="form-label fs-5">Distribuidor:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend <?php echo isset($errors["id_distribuidores"]) ? 'is-invalid border border-danger' : ''; ?>">
                                        <span class="input-group-text"><i class="fa-solid fa-truck-fast"></i></span>
                                    </div>
                                    <?php echo form_dropdown('id_distribuidores', $optionsDistribuidores, set_value('id_distribuidores'), 
                                        'class="' . (isset($errors["id_distribuidores"]) ? 'form-control is-invalid border-danger' : 'form-control select2') . '" id="id_distribuidores"'); ?>   
                                </div>
                                <?php
                                    if(isset($errors["id_distribuidores"])) echo validation_show_error('id_distribuidores');  
                                ?> 
                            </div>    
                        <?php endif; ?>

                        <div class="mb-3">
                            <label for="fecha" class="form-label fs-5">Seleccione mes y año:</label>
                            <div class="input-group">
                                
                                <div class="input-group-prepend <?php echo isset($errors["fecha"]) ? 'is-invalid border border-danger' : ''; ?>">
                                    <span class="input-group-text"><i class="fa-solid fa-calendar-days"></i></span>
                                </div>
                                <input type="month" name="fecha" id="fecha" class="form-control <?php echo isset($errors["fecha"]) ? 'is-invalid border border-danger' : ''; ?>" value="<?= set_value('fecha'); ?>">
                                <!-- Mostrar error si existe -->
                                
                            </div>
                            <?php if (isset($errors["fecha"])){
                                 echo validation_show_error('fecha');    
                            } ?>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 py-3 fs-5">
                            <i class="fa-solid fa-file-pdf"></i> Generar Factura PDF
                        </button>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

<?php include("templates/parte2.php"); ?>

<!-- Estilos adicionales -->
<style>
    .display-4 {
        font-size: 2.5rem;
    }

    .text-primary {
        color: #007bff !important;
    }

    .font-weight-bold {
        font-weight: bold;
    }

    .card {
        border-radius: 15px;
        background-color: #f8f9fa;
    }

    .card-body {
        padding: 30px;
    }

    
    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        border-radius: 10px;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }

    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 0.25rem rgba(38, 143, 255, 0.5);
    }


    .container {
        max-width: 900px;
    }

    .fs-5 {
        font-size: 1.125rem;
    }

    .py-5 {
        padding-top: 3rem !important;
        padding-bottom: 3rem !important;
    }

    .w-100 {
        width: 100%;
    }
        
</style>
