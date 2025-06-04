<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="shortcut icon" href="<?php echo baseUrl();?>/public/templates/assets/images/boral.ico">
    <!-- Agregar Bootstrap -->
    <link href="<?php echo baseUrl();?>/templates/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bootstrap-stylesheet" />
    <link href="<?php echo baseUrl();?>/templates/fontawesome-free-6.6.0-web/css/all.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo baseUrl();?>/templates/estilosPaginaPrincipal.css">
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"/>

    <script src="tinymce_7.5.0/tinymce/js/tinymce/tinymce.min.js"></script>
    
    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <link href="<?php echo baseUrl();?>/node_modules/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet" />
    
    <style>
        /* LOADER PARA TODA LA PAGINA */
    .spinner {
        width: 7rem; 
        height: 7rem; 
        border: 0.5rem solid #e2e8f0; 
        border-top: 0.5rem solid #10B981; 
        color: #10B981; 
        font-size: 2rem; 
        border-radius: 50%; 
        display: flex;
        align-items: center;
        justify-content: center;
        animation: spin 2s linear infinite; 
      }


        @keyframes spin {
          0% {
            transform: rotate(0deg);
          }
          100% {
            transform: rotate(360deg);
          }
        }


        .spinner img {
          width: 60%;
          height: 60%;
          object-fit: contain; 
          animation: ping 1s ease-in-out infinite; 
        }


        @keyframes ping {
          0% {
            transform: scale(1);
            opacity: 1;
          }
          75% {
            transform: scale(1.2);
            opacity: 0.75;
          }
          100% {
            transform: scale(1);
            opacity: 0;
          }
        }
      .centrarLoader{
        background: #f8f8f8;
        width: 100%;
        height: 100vh;
        text-align: center;
        display: flex;
        justify-content: center;
        align-items: center;
        position: fixed;
        top: 0;
        left: 0;
        z-index: 999999999999999;
        opacity: 1;
        transition: opacity 0.5s ease-in-out;
      }

      .fadeOut{
        opacity: 0;
        pointer-events: none;
      }
    
    </style>
</head>

<div class="centrarLoader" id="loader1">
            <div class="spinner">
              <img src="<?php echo baseUrl();?>/templates/assets/images/boral.png" alt="Spinner" width="30px" />
            </div>
      </div>
        
        <script>
        window.addEventListener("load",()=>{
            document.getElementById("loader1").classList.toggle("fadeOut");
        })

    </script>
