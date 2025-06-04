<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Responsive bootstrap 4 admin template" name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="<?php echo baseUrl();?>/public/templates/assets/images/boral.ico">

        <!-- App css -->
        <link href="<?php echo baseUrl();?>/templates/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" id="bootstrap-stylesheet" />
        <link href="<?php echo baseUrl();?>/templates/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo baseUrl();?>/templates/assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-stylesheet" />
        
        <link href="<?php echo baseUrl();?>/templates/fontawesome-free-6.6.0-web/css/all.css" rel="stylesheet" />
        
        <link href="<?php echo baseUrl();?>/templates/assets/libs/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" />
         <link href="<?php echo baseUrl();?>/node_modules/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet" />
        <link href="<?php echo baseUrl();?>/assets/libs/select2/select2.min.css" rel="stylesheet" type="text/css"/>
        
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
        
        <!-- Switchery CSS -->
<!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/switchery@0.8.2/dist/switchery.min.css">-->
        <!-- Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />




    <style>
        .help-block{
                color:#ff0000;
            }
       
            .is-invalid {
                border: 1.5px solid red !important;
                background-color: #f9e1e1; 
                animation: remover 1.3s ease-in-out;
            }

            .invalid-feedback {
                font-size: 15px; 
            }

            #map-container {
                height: 300px; 
                width: 100%; 
            }

            #map {
                height: 100%; 
                width: 100%;
                border-radius: 10px
            }
            
            .invalid-tinymce {
                border: 1.7px solid red !important;
                box-shadow: 0 0 5px rgba(255, 0, 0, 0.5);
            }
            
            @keyframes remover {
                0% {
                    transform: translateX(0);
                }
                25% {
                    transform: translateX(-5px);
                }
                50% {
                    transform: translateX(5px);
                }
                75% {
                    transform: translateX(-5px);
                }
                100% {
                    transform: translateX(0);
                }
            }
            
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
    z-index: 100000;
    opacity: 1;
    transition: opacity 0.5s ease-in-out;
  }

  .fadeOut{
    opacity: 0;
    pointer-events: none;
  }
</style>
</head>

<body data-layout="vertical">
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

    <div id="wrapper">

    <!-- Breadcrumb dinámico -->
    <?php
    function generateBreadcrumb() {
        $url = $_SERVER['REQUEST_URI']; 
        $url = parse_url($url, PHP_URL_PATH);
        $segments = array_filter(explode("/", trim($url, "/"))); 
        $breadcrumb = '<nav aria-label="breadcrumb"><ol class="breadcrumb">';

        $base = baseUrl();
        $baseV = explode("/", $base);

        // Definir la URL correcta para "Boral"
        if ($baseV[2] == "localhost") {
            $boralUrl = "http://localhost/boral/inicio";
        } else {
            $boralUrl = $base . "/inicio";
        }

        // Primer elemento del breadcrumb: "Boral"
        $breadcrumb .= '<li class="breadcrumb-item"><a href="' . $boralUrl . '">Boral</a></li>';

        $path = $base;

        foreach ($segments as $segment) {
            if ($baseV[2] == "localhost" && $segment == $baseV[3]) {
                continue; // Omitir el nombre del proyecto en localhost
            }

            $path .= "/" . $segment;
            $name = ucfirst(str_replace(["-", "_"], " ", $segment));
            $breadcrumb .= '<li class="breadcrumb-item"><a href="' . $path . '">' . $name . '</a></li>';
        }

        $breadcrumb .= '</ol></nav>';
        return $breadcrumb;
    }
?>


