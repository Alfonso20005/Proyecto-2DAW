<style>
    * {
        margin: 0;
        padding: 0
    }

    @page {
        size: 595pt 842pt;
    }

    table,
    tr,
    td {
        margin: 0;
        padding: 0;
    }

    .paginaA4 {
        height: 842pt;
        width: 595pt;

    }

    .cabecera {
        height: 200pt;
        width: 100%;
        background-color: transparent;
        background-image: url(<?= baseUrl();?>/assets/images/media/imgHeader.jpg);
        /* background-position: bottom;*/
        background-repeat: no-repeat;
        background-size: auto;
        border-bottom: 1px solid black;
        color:white;
    }

    .cabecera td.contenedor {
        height: 99pt;
    }

    .pie {
        height: 200pt;
        width: 100%;
        background-color: blue;
        background-image: url(<?= baseUrl();?>/assets/images/media/imagenFooter.png);
    }

    .pie td.contenedor {
        width:100%;
        height: 100pt;
        color:white;
        text-align: center;
    }


    .contenido {
        height: 100%;
    }

    .contenido td.contenido {
        vertical-align: top;
        height: 642pt;
    }

    .logo {
        width: 80pt;
        height: auto;
        margin-left: 10pt;
    }

    .cab1 {
        width: 80pt;
        text-align: center;
    }

    .cab2 {
        width: 350pt;
        text-align: center;
    }

    .cab3 {
        width: 80pt;
        text-align: center;
    }

</style>