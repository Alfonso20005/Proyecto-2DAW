
<?php include("templates/parte1.php");?>
<title>Boral | Distribuidores Edit</title>
<div class="row">
    
    <div class="col-12 d-flex justify-content-between align-items-center">
        <h1 class="text-primary font-weight-bold">EDITAR DISTRIBUIDOR</h1>

        <!-- Botón Volver -->
        <a href="<?php echo baseUrl();?>/distribuidores/volver" class="btn btn-secondary"><i class="fa-solid fa-arrow-left"></i>&nbsp; Volver</a>
    </div>
    
    <div class="col-12">
             <?php   validation_list_errors();
                    $errors=validation_errors();
            ?>
        
        <form action="<?php echo baseUrl();?>/distribuidores/actualizar" method="post" enctype="multipart/form-data" id="form1">
            <input type="hidden" name="id" id="id" value="<?= $datos["id"];?>">
            
                <div class="row mb-3">
                    <div class="mb-3 col-md-6">
                        <label for="razon_social" class="form-label">Razon Social</label>
                        <div class="input-group">
                            <div class="input-group-prepend <?php echo isset($errors["razon_social"]) ? 'is-invalid border border-danger' : ''; ?>">
                                <span class="input-group-text"><i class="fa-solid fa-briefcase"></i></span>
                            </div>
                                <?php
                                if(isset($errors["razon_social"])) 
                                    $valor=$datos["razon_social"]; 
                                else { 
                                if(set_value("razon_social")!="")  $valor=set_value("razon_social");
                                else  $valor=$datos["razon_social"]; 
                                }
                                ?>
                                <input type="text" class="form-control <?php echo isset($errors["razon_social"]) ? 'is-invalid border border-danger' : ''; ?>" id="razon_social" name="razon_social" placeholder="razon_social" value="<?=rellenarDato($errors,$datos,"razon_social");?>">
                        </div>
                        <?php
                          if(isset($errors["razon_social"])) echo validation_show_error('razon_social');  
                        ?>

                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="nombre" class="form-label">Nombre</label>
                        <div class="input-group">
                            <div class="input-group-prepend <?php echo isset($errors["nombre"]) ? 'is-invalid border border-danger' : ''; ?>">
                                <span class="input-group-text"><i class="fa fa-users"></i></span>
                            </div>
                             <input type="text" class="form-control <?php echo isset($errors["nombre"]) ? 'is-invalid border border-danger' : ''; ?>" id="nombre" name="nombre" placeholder="nombre" value="<?=rellenarDato($errors,$datos,"nombre");?>">
                        </div>
                         <?php
                          if(isset($errors["nombre"])) echo validation_show_error('nombre');  
                        ?>
                    </div>


                    <div class="mb-3 col-md-6">
                        <label for="apellidos" class="form-label">Apellidos</label>
                         <div class="input-group">
                            <div class="input-group-prepend <?php echo isset($errors["apellidos"]) ? 'is-invalid border border-danger' : ''; ?>">
                                <span class="input-group-text"><i class="fa fa-users"></i></span>
                            </div>
                            <input type="text" class="form-control <?php echo isset($errors["apellidos"]) ? 'is-invalid border border-danger' : ''; ?>" id="apellidos" name="apellidos" placeholder="apellidos" value="<?=rellenarDato($errors,$datos,"apellidos");?>">
                        </div>
                        <?php
                          if(isset($errors["apellidos"])) echo validation_show_error('apellidos');  
                        ?>
                    </div>
                    
                    <div class="mb-3 col-md-6">
                        <label for="telefono" class="form-label">Telefono</label>
                        <div class="input-group">
                            <div class="input-group-prepend <?php echo isset($errors["telefono"]) ? 'is-invalid border border-danger' : ''; ?>">
                                <span class="input-group-text"><i class="fa-solid fa-phone"></i></span>
                            </div>
                            <input type="text" class="form-control <?php echo isset($errors["telefono"]) ? 'is-invalid border border-danger' : ''; ?>" id="telefono" name="telefono" placeholder="telefono" value="<?=rellenarDato($errors,$datos,"telefono");?>">
                        </div>
                        <?php
                          if(isset($errors["telefono"])) echo validation_show_error('telefono');  
                        ?>
                    </div>
                    
                    <div class="mb-3 col-md-6">
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

                    <?php if (session()->get('role') !== 'Distribuidor'){ ?>
                    <div class="mb-3 col-md-6">
                        <label for="id_usuarios" class="form-label">Usuario</label>
                        <div class="input-group">
                            <div class="input-group-prepend <?php echo isset($errors["id_usuarios"]) ? 'is-invalid border border-danger' : ''; ?>">
                                <span class="input-group-text"><i class="fa fa-user"></i></span>
                            </div>
                               <?php
                                    if(isset($errors["id_usuarios"])) 
                                        $valor=$datos["id_usuarios"]; 
                                    else { 
                                    if(set_value("id_usuarios")!="")  $valor=set_value("id_usuarios");
                                    else  $valor=$datos["id_usuarios"]; 
                                    }
                                ?>
                                <?php echo form_dropdown('id_usuarios',$optionsUsuarios, rellenarDato($errors,$datos,"id_usuarios"),'class="' . (isset($errors["id_usuarios"]) ? 'form-control is-invalid border border-danger' : 'form-control select2') . '" id="id_usuarios" ');?>
                        </div>
                            <?php
                                if(isset($errors["id_usuarios"])) echo validation_show_error('id_usuarios');  
                            ?> 
                    </div>   
                    <?php } ?>
                </div> 

                    <div class="mb-3"> 
                        <input type="submit" class="btn btn-primary w-100" value="Aceptar" id="btnform11">
                    </div>

        </form>
        
    </div>
</div>
<?php include("templates/parte2.php");?>