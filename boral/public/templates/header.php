<div class="navbar-custom">
                <ul class="list-unstyled topnav-menu float-right mb-0">
                    
                    
<!--                MUESTRO EL TIEMPO Y SI LE DOY ME SALE UN POPUP CON EL TIEMPO-->
                    <li class="dropdown abrir_temporizador">
                        <a href="javascript:void(0);" class="nav-link waves-effect">
                            <i class="mdi mdi-clock-outline"></i> 
                            <span id="current-time"></span>
                        </a>
                    </li>

<!--                    REPORTAR ALGUNA INCIDENCIA O PROBLEMA-->
                    <li class="dropdown notification-list">
                        <a href="<?php echo baseUrl();?>/incidencias" class="nav-link waves-effect">
<!--                            <i class="mdi mdi-help-circle-outline noti-icon"></i>-->
                            <i class="fa-solid fa-circle-exclamation fa-lg"></i>

                        </a>
                    </li>

<!--                    PARA QUE LA RUEDITA DE CONFIGURACION SOLO ESTE EN EL DASHBOARD-->
                  <?php if (strpos(current_url(), baseUrl() . '/inicio') !== false): ?> 
                        <li class="dropdown notification-list">
                            <a href="javascript:void(0);" class="nav-link right-bar-toggle waves-effect">
                                <i class="mdi mdi-settings noti-icon"></i>
                            </a>
                        </li>
                    <?php endif; ?>
                
                </ul>
    
          

                <div class="logo-box">
                    
                    <a href="#" class="logo text-center">
                        <span class="logo-lg">
                            <img src="<?php echo baseUrl();?>/templates/assets/images/boralTexto.png" alt="" height="35">
                            <!-- <span class="logo-lg-text-light">Zircos</span> -->
                        </span>
                        <span class="logo-sm">
                            <!-- <span class="logo-sm-text-dark">Z</span> -->
                            <img src="<?php echo baseUrl();?>/templates/assets/images/boral.png" alt="" height="45">
                        </span>
                    </a>              
                </div>
    
                  <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
                        <li>
                            <button class="button-menu-mobile waves-effect">
                                <i class="mdi mdi-menu"></i>
                            </button>
                        </li>

                </ul>

        
</div>


<div class="left-side-menu">
    <div class="avatar-section" style="display: block;">
        <div class="avatar-container">
                <img src="<?php echo base_url(session()->get('imagen')); ?>" class="rounded-circle mb-3" alt="" height="60px"><br> 
            <i class="fa-solid fa-circle fa-2xs mr-1" style="color: #20fe3a;"></i>
            <span class="text-light spanRole"><?php echo session()->get('role');?></span><br>

        </div>
        <div class="avatar-container mb-3 mt-3">
            <a href="<?php echo baseUrl();?>/perfilUser?id=<?php echo session()->get('id');?>"> 
                <i class="fa-solid fa-user btnPerfil" style="color: #005eff;"></i> 
            </a>

            <a href="<?php echo baseUrl();?>/"> 
               
                <i class="fa-solid fa-house ml-4 btnPerfil" style="color: #3cc520;"></i> 
            </a>
            
            <a href="#" class="logout">
                <i class="fa-solid fa-power-off ml-4 btnPerfil" style="color: #ff0000;"></i>
            </a>

        </div>
    </div>
        
                    <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 397px;"><div class="slimscroll-menu" style="overflow: hidden; width: auto; height: 397px;">
    
                        <!--- Sidemenu -->
                        <div id="sidebar-menu">
    
                            <ul class="metismenu" id="side-menu">
    
                                <li class="menu-title">Panel de control</li>
    
                                
                                <?php if (session()->get('role') === 'Administrador' || session()->get('role') === 'SuperAdmin'){ ?>
                                
                                <li>
                                    <a href="javascript: void(0);" class="waves-effect waves-light">
                                        <i class="fas fa-chart-line"></i>
                                        <span>  Dashboard  </span>
                                        <span class="menu-arrow"></span>
                                    </a>
                                    <ul class="nav-second-level mm-collapse" aria-expanded="false">
                                        <li><a href="<?php echo baseUrl();?>/inicio">Dashboard</a></li>
                                    </ul>
                                </li>
    
                                    <li>
                                        <a href="javascript: void(0);" class="waves-effect waves-light">
                                            <i class="fa-solid fa-crown"></i>
                                            <span>  Roles  </span>
                                            <span class="menu-arrow"></span>
                                        </a>
                                        
                                        <ul class="nav-second-level mm-collapse" aria-expanded="false">
                                           <li><a href="<?php echo baseUrl();?>/roles">Listado</a></li>
                                        </ul>
                                    </li>
                                
                                
                                    <li>
                                        <a href="javascript: void(0);" class="waves-effect waves-light">
                                            <i class="fa-solid fa-users"></i>
                                            <span>  Usuarios  </span>
                                            <span class="menu-arrow"></span>
                                        </a>
                                        <ul class="nav-second-level mm-collapse" aria-expanded="false">
                                           <li><a href="<?php echo baseUrl();?>/usuarios">Listado</a></li>
                                        </ul>
                                    </li>
                    
<!--
                                <li>
                                        <a href="javascript: void(0);" class="waves-effect waves-light">
                                            <i class="fa-solid fa-building-user"></i>
                                            <span>  Provincias  </span>
                                            <span class="menu-arrow"></span>
                                        </a>
                                        <ul class="nav-second-level mm-collapse" aria-expanded="false">
                                           <li><a href="<?php echo baseUrl();?>/provincias">Listado</a></li>
                                            <li><a href="<?php echo baseUrl();?>/provincias/nuevo">Nuevo</a></li>
                                        </ul>
                                    </li>
-->
                                
                                <?php }elseif(session()->get('role') === 'Distribuidor'){ ?>
                                
                                 <li>
                                        <a href="javascript: void(0);" class="waves-effect waves-light">
                                            <i class="fa-solid fa-truck-fast"></i>
                                            <span>  Distribuidores  </span>
                                            <span class="menu-arrow"></span>
                                        </a>
                                        <ul class="nav-second-level mm-collapse" aria-expanded="false">
                                           <li><a href="<?php echo baseUrl();?>/distribuidores">Listado</a></li>
                                        </ul>
                                </li>
                                <?php } ?>
                                
                                <?php if (session()->get('role') === 'Administrador' || session()->get('role') === 'SuperAdmin'){ ?>
                                
                                <li>
                                        <a href="javascript: void(0);" class="waves-effect waves-light">
                                            <i class="fa-solid fa-truck-fast"></i>
                                            <span>  Distribuidores  </span>
                                            <span class="menu-arrow"></span>
                                        </a>
                                        <ul class="nav-second-level mm-collapse" aria-expanded="false">
                                           <li><a href="<?php echo baseUrl();?>/distribuidores">Listado</a></li>
                                        </ul>
                                </li>
                                
                                
                                <li>
                                        <a href="javascript: void(0);" class="waves-effect waves-light">
                                            <i class="fas fa-box-open"></i>
                                            <span>  Proveedores  </span>
                                            <span class="menu-arrow"></span>
                                        </a>
                                        <ul class="nav-second-level mm-collapse" aria-expanded="false">
                                           <li><a href="<?php echo baseUrl();?>/proveedores">Listado</a></li>
                                        </ul>
                                </li>
                                
                                <li>
                                        <a href="javascript: void(0);" class="waves-effect waves-light">
                                            <i class="fas fa-folder"></i>
                                            <span>  Categorias C.  </span>
                                            <span class="menu-arrow"></span>
                                        </a>
                                        <ul class="nav-second-level mm-collapse" aria-expanded="false">
                                           <li><a href="<?php echo baseUrl();?>/categorias_compra">Listado</a></li>
                                        </ul>
                                </li>
                                
                                <li>
                                        <a href="javascript: void(0);" class="waves-effect waves-light">
                                            <i class="fas fa-shopping-cart"></i>
                                            <span>  Productos Compra  </span>
                                            <span class="menu-arrow"></span>
                                        </a>
                                        <ul class="nav-second-level mm-collapse" aria-expanded="false">
                                           <li><a href="<?php echo baseUrl();?>/productos_compra">Listado</a></li>
                                        </ul>
                                </li>
                                
                                <li>
                                        <a href="javascript: void(0);" class="waves-effect waves-light">
                                            <i class="fas fa-folder"></i>
                                            <span>  Categorias V.  </span>
                                            <span class="menu-arrow"></span>
                                        </a>
                                        <ul class="nav-second-level mm-collapse" aria-expanded="false">
                                           <li><a href="<?php echo baseUrl();?>/categorias_venta">Listado</a></li>
                                        </ul>
                                </li>
                                
                                <?php }elseif(session()->get('role') === 'Distribuidor'){ ?>
                                <li>
                                        <a href="javascript: void(0);" class="waves-effect waves-light">
                                           <i class="fa-solid fa-money-bill-trend-up"></i>
                                            <span>  Productos Venta  </span>
                                            <span class="menu-arrow"></span>
                                        </a>
                                        <ul class="nav-second-level mm-collapse" aria-expanded="false">
                                           <li><a href="<?php echo baseUrl();?>/productos_venta">Listado</a></li>
                                        </ul>
                                </li>
                                
                              
                                <li>
                                        <a href="javascript: void(0);" class="waves-effect waves-light">
                                           <i class="fas fa-box"></i>
                                            <span>  Pedidos  </span>
                                            <span class="menu-arrow"></span>
                                        </a>
                                        <ul class="nav-second-level mm-collapse" aria-expanded="false">
                                           <li><a href="<?php echo baseUrl();?>/pedidos">Listado</a></li>
                                        </ul>
                                </li>
                                <?php } ?>
                                
                                <?php if (session()->get('role') === 'Administrador' || session()->get('role') === 'SuperAdmin'){ ?>
                                <li>
                                        <a href="javascript: void(0);" class="waves-effect waves-light">
                                           <i class="fa-solid fa-money-bill-trend-up"></i>
                                            <span>  Productos Venta  </span>
                                            <span class="menu-arrow"></span>
                                        </a>
                                        <ul class="nav-second-level mm-collapse" aria-expanded="false">
                                           <li><a href="<?php echo baseUrl();?>/productos_venta">Listado</a></li>
                                        </ul>
                                </li>
                                
                                <li>
                                        <a href="javascript: void(0);" class="waves-effect waves-light">
                                           <i class="fas fa-box"></i>
                                            <span>  Pedidos  </span>
                                            <span class="menu-arrow"></span>
                                        </a>
                                        <ul class="nav-second-level mm-collapse" aria-expanded="false">
                                           <li><a href="<?php echo baseUrl();?>/pedidos">Listado</a></li>
                                        </ul>
                                </li>
                                
                                
                                
                                <?php } ?>

                                <li>
                                        <a href="javascript: void(0);" class="waves-effect waves-light">
                                          <i class="fas fa-file-alt"></i>
                                            <span>  Facturas  </span>
                                            <span class="menu-arrow"></span>
                                        </a>
                                        <ul class="nav-second-level mm-collapse" aria-expanded="false">
                                           <li><a href="<?php echo baseUrl();?>/factura">Listado</a></li>
                                        </ul>
                                </li>
                                 
    
                            </ul>
    
                        </div>
                        <!-- End Sidebar -->
                    <div class="help-box">
                            <h5 class="text-muted mt-0">Para Ayuda ?</h5>
                            <p class=""><span class="text-info">Email:</span>
                                <br> alfonso@gmail.com</p>
                            <p class="mb-0"><span class="text-info">Llamar:</span>
                                <br> (+34) 669 71 01 07</p>
                        </div>
                       <br><br><br><br><br><br> 
                        
                    
                    </div><div class="slimScrollBar" style="background: rgb(158, 165, 171); width: 5px; position: absolute; top: -191.031px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 141.607px;"></div><div class="slimScrollRail" style="width: 5px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;"></div></div>
                    <!-- Sidebar -left -->
    
                </div>


<div class="right-bar">
            <div class="rightbar-title">
                <a href="javascript:void(0);" class="right-bar-toggle float-right">
                    <i class="mdi mdi-close"></i>
                </a>
                <h4 class="font-16 m-0 text-white">Cambiar Tema</h4>
            </div>
            <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 252.5px;"><div class="slimscroll-menu" style="overflow: hidden; width: auto; height: 252.5px;">
        
                <div class="p-4">
                    <div class="alert alert-warning" role="alert">
                        Personaliza el diseño
                    </div>
                    <div class="mb-2">
                        <img src="assets/images/layouts/light.png" class="img-fluid img-thumbnail" alt="">
                    </div>
                    <div class="custom-control custom-switch mb-3">
                        <input type="checkbox" class="custom-control-input theme-choice" id="light-mode-switch" checked="">
                        <label class="custom-control-label" for="light-mode-switch">Light Mode</label>
                    </div>
            
                    <div class="mb-2">
                        <img src="assets/images/layouts/dark.png" class="img-fluid img-thumbnail" alt="">
                    </div>
                    <div class="custom-control custom-switch mb-3">
                        <input type="checkbox" class="custom-control-input theme-choice" id="dark-mode-switch" data-bsstyle="assets/css/bootstrap-dark.min.css" data-appstyle="assets/css/app-dark.min.css">
                        <label class="custom-control-label" for="dark-mode-switch">Dark Mode</label>
                    </div>
            
                </div>
            </div><div class="slimScrollBar" style="background: rgb(158, 165, 171); width: 5px; position: absolute; top: 90px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 66.0003px;"></div><div class="slimScrollRail" style="width: 5px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;"></div></div> <!-- end slimscroll-menu-->
        </div>
<div class="rightbar-overlay"></div>

<?php include("stylesHeader.php");?>

<script>
setInterval(function() {
    let sessionStartTime = localStorage.getItem("sessionStartTime");
    if (sessionStartTime) {
        let tiempo = Math.floor((new Date() - new Date(sessionStartTime)) / 1000); // tiempo en segundos
        let horas = Math.floor(tiempo / 3600); // Calcular horas
        let minutos = Math.floor((tiempo % 3600) / 60); // Calcular minutos (resto de los segundos de la hora)
        let segundos = tiempo % 60; // Calcular segundos restantes
        document.getElementById("current-time").innerText = horas + "h " + minutos + "m " + segundos + "s";
    }
}, 1000);
    
    // Si no existe el tiempo de inicio de sesión, se guarda
    if (!localStorage.getItem("sessionStartTime")) {
        localStorage.setItem("sessionStartTime", new Date());
    }
    
    // Al hacer clic en el botón del menú, alternar la visibilidad del avatar
    document.querySelector('.button-menu-mobile').addEventListener('click', function() {
        var avatarSection = document.querySelector('.avatar-section');
        avatarSection.style.display = (avatarSection.style.display === 'none' || avatarSection.style.display === '') ? 'block' : 'none';
    });
    
</script>
