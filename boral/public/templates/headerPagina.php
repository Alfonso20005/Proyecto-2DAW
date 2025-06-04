<header>
        <div class="container-fluid">
            <div class="row align-items-center">
                <!-- Logo a la izquierda -->
                <div class="col-md-3">
                    <a href="#"><img src="<?php echo baseUrl();?>/templates/assets/images/boral.png" alt="Logo de Boral" class="img-fluid" style="max-height: 90px;"></a>
                </div>

                <!-- Menú de navegación al centro -->
                <div class="col-md-6 text-center">
                    <nav class="nav justify-content-center">
                        <a class="nav-link px-3" href="#">Inicio</a>
                        <a class="nav-link px-3" href="#sobre-nosotros">Sobre Nosotros</a>
                        <a class="nav-link px-3" href="#productos">Productos</a>
                        <a class="nav-link px-3" href="#contactanos">Contáctanos</a>
                        
                        
                    </nav>
                </div>

                <!-- Enlace de Login a la derecha -->
                <div>
                    <?php if(!session()->get('id')) { ?>
                    
                        <a href="<?php echo base_url(); ?>login" class="animated-button">
                          <svg viewBox="0 0 24 24" class="arr-2" xmlns="http://www.w3.org/2000/svg">
                            <path
                              d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"
                            ></path>
                          </svg>
                          <span class="text">Inicio Sesion</span>
                          <span class="circle"></span>
                          <svg viewBox="0 0 24 24" class="arr-1" xmlns="http://www.w3.org/2000/svg">
                            <path
                              d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"
                            ></path>
                          </svg>
                        </a>

                    
                    <?php }else{ ?>
                       <a class="user-button" href="<?= (session()->get('role') !== 'Usuario') ? base_url('inicio') : base_url('/perfilUserPagina?id=' . session()->get('id')) ?>">
                            <img src="<?php echo base_url(session()->get('imagen')); ?>" alt="User Image">
                            <span style="color:black;"><?php echo session()->get('usuario'); ?></span>
                        </a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </header>


