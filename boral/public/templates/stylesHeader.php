<style>
    .avatar-container {
    text-align: center; /* Centra el contenido dentro del contenedor */
     /* Espacio entre la imagen y el resto del contenido */
}

.avatar-container img {
    display: inline-block; /* Asegura que la imagen se trate como un bloque en línea */
    border-radius: 50%; /* Si quieres que sea circular */
}
    
.btnPerfil {
    display: inline-block; /* Asegura que los iconos se comporten como elementos de bloque en línea */
    padding: 7px; /* Espacio interno dentro del "botón" */
    border-radius: 50%; /* Bordes redondeados, para un aspecto de botón circular */
    font-size: 24px; /* Tamaño de los iconos */
    cursor: pointer; /* Cambia el cursor al pasar por encima para indicar que es interactivo */
    transition: all 0.3s ease; /* Transición suave para los efectos */
}

/* Efecto de hover para resaltar los iconos cuando el mouse está encima */
.btnPerfil:hover {
    transform: scale(1.1); /* Hace que el icono crezca un poco cuando el mouse está encima */
    background-color: rgba(0, 94, 255, 0.1); /* Fondo suave cuando el mouse está encima */
}

/* Efecto específico para el primer icono (usuario) */
.avatar-container i.fa-user {
    background-color: rgba(0, 94, 255, 0.2); /* Fondo de color azul claro */
}

.avatar-container i.fa-house {
    background-color: rgba(0, 255, 0, 0.2); /* Fondo de color verde claro */
}


/* Efecto específico para el segundo icono (apagado) */
.avatar-container i.fa-power-off {
    background-color: rgba(255, 0, 0, 0.2); /* Fondo de color rojo claro */
}

/* Efecto de enfoque (focus) para cuando el icono recibe el foco */
.btnPerfil:focus {
    outline: none; /* Elimina el borde por defecto */
    box-shadow: 0 0 5px 2px rgba(0, 94, 255, 0.5); /* Agrega un resplandor suave alrededor del icono */
}
    

.left-side-menu {
    height: 100vh !important; 
    overflow-y: auto !important; 
}

.slimScrollDiv {
    height: 100vh !important;
    overflow: hidden !important;
}


.slimscroll-menu {
    height: 100% !important; 
    overflow-y: auto !important;
}

    
  
.slimScrollDiv::-webkit-scrollbar {
    width: 6px !important; 
}

.slimScrollDiv::-webkit-scrollbar-thumb {
    background-color: rgba(255, 255, 255, 0.2) !important; 
    border-radius: 4px !important;
    transition: background 0.3s ease-in-out !important; 
}

.slimScrollDiv::-webkit-scrollbar-thumb:hover {
    background-color: rgba(255, 255, 255, 0.4) !important; 
}

.slimScrollDiv::-webkit-scrollbar-track {
    background: transparent !important; 
}

/*FIREFOX*/
.slimScrollDiv {
    scrollbar-width: thin !important; 
    scrollbar-color: rgba(255, 255, 255, 0.2) transparent !important;
}

    
.left-side-menu::-webkit-scrollbar {
    width: 6px !important; 
}

.left-side-menu::-webkit-scrollbar-thumb {
    background-color: rgba(255, 255, 255, 0.2) !important; 
    border-radius: 4px !important; 
    transition: background 0.3s ease-in-out !important;
}

.left-side-menu::-webkit-scrollbar-thumb:hover {
    background-color: rgba(255, 255, 255, 0.4) !important; 
}

.left-side-menu::-webkit-scrollbar-track {
    background: transparent !important; 
}

/*FIREFOX*/
.left-side-menu {
    scrollbar-width: thin !important; 
    scrollbar-color: rgba(255, 255, 255, 0.2) transparent !important; 
}

    
    /* Color del texto para el rol en el modo claro */
.spanRole {
    color: #fff !important; /* Color oscuro para el modo claro */
}
</style>