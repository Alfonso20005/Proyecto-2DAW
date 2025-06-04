<main>
    <!-- Contenedor de la imagen de fondo -->
    <div class="image-container" style="position: relative;">
        <img src="<?php echo baseUrl();?>/templates/assets/images/imgFondoPagina.png" alt="Pastelería y bollería artesanal de alta calidad - Boral Pastelería" class="full-width-image">
        
        <!-- Contenido sobre la imagen para SEO -->
        <div class="overlay-text" style="position: absolute; top: 50%; left: 190px; transform: translateY(-50%); color: white; padding: 20px; max-width: 762px;">
            <div class="loader">
                <p style="color: white;">Boral&nbsp;</p>
                <div class="words">
                    <span href="" class="typewrite" data-period="2000" data-type='["Bollería Artesanal","Pastelería Gourmet","Sabores Artesanales","Croissants Deliciosos","Tartas Personalizadas"]'>
                        <span class="wrap"></span>
                    </span>
<!--
                    <span class="word">Bollería Artesanal</span>
                    <span class="word">Pastelería Gourmet</span>
                    <span class="word">Sabores Artesanales</span>
                    <span class="word">Croissants Deliciosos</span>
                    <span class="word">Tartas Personalizadas</span>
-->
                </div>
            </div>

            <p><strong>Boral Pastelería</strong> es tu destino para disfrutar de <strong>bollería artesanal</strong><br> y <strong>pastelería gourmet</strong>. Ofrecemos una variedad de productos frescos,<br> como <strong>panes artesanales</strong>, <strong>croissants</strong> y <strong>pasteles personalizados</strong>.</p>
            <a href="#productos">
                <button class="btn-53">
                  <div class="original">Ver Productos</div>
                  <div class="letters">

                    <span>V</span>
                    <span>e</span>
                    <span>r</span>
                    <span>&nbsp;</span>
                    <span>P</span>
                    <span>r</span>
                    <span>o</span>
                    <span>d</span>
                    <span>u</span>
                    <span>c</span>
                    <span>t</span>
                    <span>o</span>
                    <span>s</span>
                  </div>
                </button>
            </a>
        </div>
        
         <div class="right-image" style="position: absolute; top: 50%; right: 190px; transform: translateY(-50%); overflow: hidden; width: 350px;">
            <!-- Contenedor de las imágenes del slider -->
            <div class="slider" style="display: flex; transition: transform 1s ease-in-out;">
                <!-- Imágenes del slider -->
                <img src="<?php echo baseUrl();?>/templates/assets/images/imagenesInicio/palmeritaWEB.jpg" alt="Imagen de productos" style="max-width: 350px; height: auto; border-radius: 20px;">
                <img src="<?php echo baseUrl();?>/templates/assets/images/imagenesInicio/napolitana.jpg" alt="Imagen de productos" style="max-width: 350px; height: auto; border-radius: 20px;">
                <img src="<?php echo baseUrl();?>/templates/assets/images/imagenesInicio/croissant.jpg" alt="Imagen de productos" style="max-width: 350px; height: auto; border-radius: 20px;">
                <img src="<?php echo baseUrl();?>/templates/assets/images/imagenesInicio/croissantchoco.jpg" alt="Imagen de productos" style="max-width: 350px; height: auto; border-radius: 20px;">
            </div>
        </div>
    </div>
    <br><br><br>
<section id="sobre-nosotros" style="text-align: center; margin-top: 50px;">
    <h2 style="color: green; font-size: 2.5rem;">SOBRE NOSOTROS</h2>
    <hr style="border: 1px solid green; width: 50%; margin: 20px auto;">
</section>

<!-- Sección con flexbox para el Spline y el texto -->
<section id="descripcion" style="display: flex; align-items: center; justify-content: space-between; height: 600px;">
    <!-- Contenedor de Spline Viewer -->
    <div class="spline-container" style="width: 45%; height: 100%; margin-left: 127px;">
        <!-- Spline Viewer -->
        <div class="spline-wrapper" style="width: 100%; height: 100%; border-radius: 10px; position: relative;">
            <script type="module" src="https://unpkg.com/@splinetool/viewer@1.9.86/build/spline-viewer.js"></script>
            <spline-viewer url="https://prod.spline.design/VXrfutatwJl8OnUk/scene.splinecode" style="width: 100%; height: 100%;"></spline-viewer>
            <div style="position: absolute; bottom: 17px; left: 553px; width: 21%; height: 40px; background-color: #f8f8f8; z-index: 9999;"></div>
        </div>
    </div>

    <!-- Contenedor del texto descriptivo -->
    <div style="flex: 1; font-size: 1.2rem; line-height: 1.6; color: #333; max-width: 40%; text-align: left; margin-right: 130px;">
        <p>
            En <strong>Boral Pastelería</strong>, nuestra pasión por la repostería se refleja en cada uno de nuestros productos. Nos especializamos en crear momentos memorables a través de nuestras deliciosas <strong>bollerías artesanales</strong> y <strong>pasteles personalizados</strong>. Cada pieza está elaborada con ingredientes frescos y de calidad, con un toque único que solo se consigue en la repostería hecha a mano.
        </p>
        <p>
            Ya sea que busques un <strong>croissant</strong> esponjoso para empezar el día, una <strong>tarta gourmet</strong> para una ocasión especial o un <strong>pan artesanal</strong> para acompañar tu comida, en Boral lo tenemos todo. Nos enorgullece ofrecer productos que no solo son deliciosos, sino también una experiencia visualmente atractiva. Nuestro equipo de reposteros está comprometido con la calidad y la excelencia.
        </p>
    </div>
</section>


    
<section id="productos" style="text-align: center; margin-top: 30px;">
    <h2 style="color: green; font-size: 2.5rem;">PRODUCTOS</h2>
    <hr style="border: 1px solid green; width: 50%; margin: 20px auto;">
</section>
        
<div class="container">
    <!-- Filtros -->
    <ul class="nav nav-pills" style="justify-content: center;">
        <li class="filter active" data-filter="all">
            <a href="#noAction">Todo</a>
        </li>
        <li class="filter" data-filter="bolleria">
            <a href="#noAction">Bolleria</a>
        </li>
        <li class="filter" data-filter="pasteleria">
            <a href="#noAction">Pasteleria</a>
        </li>
        <li  style="margin: 0 10px;">
        <div class="container1">
            <label class="label">
                <input type="checkbox" class="input" onchange="triggerDownload(this)"/>
                <span class="circle">
                    <svg class="icon" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 19V5m0 14-4-4m4 4 4-4"></path>
                    </svg>
                    <div class="square"></div>
                </span>
                <p class="title">DESCARGAR</p>
                <p class="title"><i class="fa-solid fa-check" style="color: #78ec74;"></i></p>
            </label>
        </div>
    </li>
    </ul>
    
</div>

<div class="product-container" style="display: flex; flex-wrap: wrap; justify-content: center; gap: 30px; margin-top: 30px;">
    <!-- Producto 1 -->
    <div class="product-item" data-category="pasteleria" style="width: 30%; background-color: #f7f7f7; border-radius: 10px; padding: 15px; text-align: center; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
        <div class="product-inner" style="border: 1px solid #ddd; border-radius: 10px; padding: 10px;">
            <img src="<?php echo baseUrl();?>/templates/assets/images/imagenesInicio/palmeritaWEB.jpg" alt="Producto 1" style="width: 100%; height: auto; border-radius: 10px;">
            <h4 style="color: #333; margin-top: 15px;">Palmerita Chocolate Blanco</h4>
            <p style="color: #777; font-weight: bold;">0,80€</p> 
            <div style="margin-top: 10px;">
                <img src="<?php echo baseUrl();?>/templates/assets/images/imagenesInicio/trigo.png" alt="Alergeno Trigo" style="width: 20px; height: auto;">
                <span style="color: #777; font-size: 0.9rem; margin-left: 5px;">Contiene trigo</span>
            </div>
            <button class="button-ps">Comprar</button>
        </div>
    </div>

    <!-- Producto 2 -->
    <div class="product-item" data-category="bolleria" style="width: 30%; background-color: #f7f7f7; border-radius: 10px; padding: 15px; text-align: center; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
        <div class="product-inner" style="border: 1px solid #ddd; border-radius: 10px; padding: 10px;">
            <img src="<?php echo baseUrl();?>/templates/assets/images/imagenesInicio/napolitana.jpg" alt="Producto 2" style="width: 100%; height: auto; border-radius: 10px;">
            <h4 style="color: #333; margin-top: 15px;">Napolitana Chocolate</h4>
            <p style="color: #777; font-weight: bold;">1,00€</p> 
            <div style="margin-top: 10px;">
                <img src="<?php echo baseUrl();?>/templates/assets/images/imagenesInicio/trigo.png" alt="Alergeno Trigo" style="width: 20px; height: auto;">
                <span style="color: #777; font-size: 0.9rem; margin-left: 5px;">Contiene trigo</span>
            </div>
            <button class="button-ps">Comprar</button>
        </div>
    </div>

    <!-- Producto 3 -->
    <div class="product-item" data-category="bolleria" style="width: 30%; background-color: #f7f7f7; border-radius: 10px; padding: 15px; text-align: center; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
        <div class="product-inner" style="border: 1px solid #ddd; border-radius: 10px; padding: 10px;">
            <img src="<?php echo baseUrl();?>/templates/assets/images/imagenesInicio/croissant.jpg" alt="Producto 3" style="width: 100%; height: auto; border-radius: 10px;">
            <h4 style="color: #333; margin-top: 15px;">Croissant</h4>
            <p style="color: #777; font-weight: bold;">1,00€</p> 
            <div style="margin-top: 10px;">
                <img src="<?php echo baseUrl();?>/templates/assets/images/imagenesInicio/trigo.png" alt="Alergeno Trigo" style="width: 20px; height: auto;">
                <span style="color: #777; font-size: 0.9rem; margin-left: 5px;">Contiene trigo</span>
            </div>
            <button class="button-ps">Comprar</button>
        </div>
    </div>

    <!-- Producto 4 -->
    <div class="product-item" data-category="bolleria" style="width: 30%; background-color: #f7f7f7; border-radius: 10px; padding: 15px; text-align: center; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
        <div class="product-inner" style="border: 1px solid #ddd; border-radius: 10px; padding: 10px;">
            <img src="<?php echo baseUrl();?>/templates/assets/images/imagenesInicio/croissantchoco.jpg" alt="Producto 4" style="width: 100%; height: auto; border-radius: 10px;">
            <h4 style="color: #333; margin-top: 15px;">Croissant Chocolate</h4>
            <p style="color: #777; font-weight: bold;">1,50€</p> 
            <div style="margin-top: 10px;">
                <img src="<?php echo baseUrl();?>/templates/assets/images/imagenesInicio/trigo.png" alt="Alergeno Trigo" style="width: 20px; height: auto;">
                <span style="color: #777; font-size: 0.9rem; margin-left: 5px;">Contiene trigo</span>
            </div>
            <button class="button-ps">Comprar</button>
        </div>
    </div>

    <!-- Producto 5 -->
    <div class="product-item" data-category="pasteleria" style="width: 30%; background-color: #f7f7f7; border-radius: 10px; padding: 15px; text-align: center; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
        <div class="product-inner" style="border: 1px solid #ddd; border-radius: 10px; padding: 10px;">
            <img src="<?php echo baseUrl();?>/templates/assets/images/imagenesInicio/palemeraChocolate.jpg" alt="Producto 5" style="width: 100%; height: auto; border-radius: 10px;">
            <h4 style="color: #333; margin-top: 15px;">Palmera Chocolate</h4>
            <p style="color: #777; font-weight: bold;">1,80€</p>
            <div style="margin-top: 10px;">
                <img src="<?php echo baseUrl();?>/templates/assets/images/imagenesInicio/trigo.png" alt="Alergeno Trigo" style="width: 20px; height: auto;">
                <span style="color: #777; font-size: 0.9rem; margin-left: 5px;">Contiene trigo</span>
            </div>
            <button class="button-ps">Comprar</button>
        </div>
    </div>

    <!-- Producto 6 -->
    <div class="product-item" data-category="pasteleria" style="width: 30%; background-color: #f7f7f7; border-radius: 10px; padding: 15px; text-align: center; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
        <div class="product-inner" style="border: 1px solid #ddd; border-radius: 10px; padding: 10px;">
            <img src="<?php echo baseUrl();?>/templates/assets/images/imagenesInicio/churroChoco.jpg" alt="Producto 6" style="width: 100%; height: auto; border-radius: 10px;">
            <h4 style="color: #333; margin-top: 15px;">Churros Chocolate</h4>
            <p style="color: #777; font-weight: bold;">1,50€</p>
            <div style="margin-top: 10px;">
                <img src="<?php echo baseUrl();?>/templates/assets/images/imagenesInicio/trigo.png" alt="Alergeno Trigo" style="width: 20px; height: auto;">
                <span style="color: #777; font-size: 0.9rem; margin-left: 5px;">Contiene trigo</span>
            </div>
            <button class="button-ps">Comprar</button>
        </div>
    </div>
</div>

        
        
        
  <br><br><br>
    <section id="contactanos" style="text-align: center; margin-top: 50px;">
    <h2 style="color: green; font-size: 2.5rem;">CONTÁCTANOS</h2>
    <hr style="border: 1px solid green; width: 50%; margin: 20px auto;">
    
   
       <div style="display: flex; flex-direction: row; justify-content: space-between; align-items: flex-start; margin-top: 30px; padding: 0 100px;">
            <div style="flex: 1; text-align: left; margin-right: 20px;">
                <div class="contact-form">
            <img src="<?php echo baseUrl();?>/templates/assets/images/boral.png" alt="" width="100px" height="auto">
        
            <?php validation_list_errors();
                    $errors=validation_errors();


            ?>        

            <form action="<?php echo baseUrl();?>/incidencias/enviar" method="post" enctype="multipart/form-data" id="form1">
                <h1 style="font-size: 56px;">Contacto</h1>
                
                <div class="control-group" style="margin-bottom:15px;">
                    <div class="controls">
                        <input class="<?php echo isset($errors["email"]) ? 'is-invalid border border-danger' : ''; ?>" style="padding: 20px;" type="text" id="email" name="email" placeholder="Correo electrónico" value="<?= set_value('email');?>"/>      
                    </div>
                    <?php if (isset($errors["email"])) echo validation_show_error('email'); ?>
                </div>
                
                <div class="control-group">
                    <div class="controls">
                        <textarea class="<?php echo isset($errors["descripcion"]) ? 'is-invalid' : ''; ?>" id="descripcion" name="descripcion" placeholder="Escribe aquí tu mensaje"><?= set_value('descripcion'); ?></textarea>
                    </div>
                    <?php if (isset($errors["descripcion"])) echo validation_show_error('descripcion'); ?>
                </div>
                
                <div class="control-group">
                    <div class="controls">
                        <button id="send-mail" class="message-btn button button-ps" type="submit">Enviar</button>
                    </div>
                </div>
            </form>
        </div>
            </div>
            <div class="map-canvas" id="map-canvas1" style="width: 45%; height: 653px; border-radius: 10px;"></div>
        </div>
</section>
        
<br><br><br>
        
</main>

<script>
    function triggerDownload(checkbox) {
        if (checkbox.checked) {
            const link = document.createElement('a');
            link.href = "<?php echo base_url(); ?>/productos_venta/exportar"; // CodeIgniter 4 URL
            link.setAttribute('download', 'archivo.xlsx'); // nombre sugerido
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }
    }
    
    
    
    
        
    var TxtType = function(el, toRotate, period) {
    this.toRotate = toRotate;
    this.el = el;
    this.loopNum = 0;
    this.period = parseInt(period, 10) || 2000;
    this.txt = '';
    this.tick();
    this.isDeleting = false;
};

TxtType.prototype.tick = function() {
    var i = this.loopNum % this.toRotate.length;
    var fullTxt = this.toRotate[i];

    if (this.isDeleting) {
    this.txt = fullTxt.substring(0, this.txt.length - 1);
    } else {
    this.txt = fullTxt.substring(0, this.txt.length + 1);
    }

    this.el.innerHTML = '<span class="wrap">'+this.txt+'</span>';

    var that = this;
    var delta = 200 - Math.random() * 100;

    if (this.isDeleting) { delta /= 2; }

    if (!this.isDeleting && this.txt === fullTxt) {
    delta = this.period;
    this.isDeleting = true;
    } else if (this.isDeleting && this.txt === '') {
    this.isDeleting = false;
    this.loopNum++;
    delta = 500;
    }

    setTimeout(function() {
    that.tick();
    }, delta);
};

window.onload = function() {
    var elements = document.getElementsByClassName('typewrite');
    for (var i=0; i<elements.length; i++) {
        var toRotate = elements[i].getAttribute('data-type');
        var period = elements[i].getAttribute('data-period');
        if (toRotate) {
          new TxtType(elements[i], JSON.parse(toRotate), period);
        }
    }
    // INJECT CSS
    var css = document.createElement("style");
    css.type = "text/css";
    css.innerHTML = ".typewrite > .wrap { border-right: 0.08em solid #fff}";
    document.body.appendChild(css);
};
</script>