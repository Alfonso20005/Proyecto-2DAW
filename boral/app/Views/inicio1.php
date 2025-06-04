<!DOCTYPE html>
<html lang="en">
    <title>Boral</title>
    <!-- Head -->
    <?php include("templates/headPagina.php"); ?>
<body>

    <!-- Header -->
    <?php include("templates/headerPagina.php"); ?>

    <!-- Contenido principal -->
    <?php include("templates/mainPagina.php"); ?>
    
    <!-- Footer -->
    <?php include("templates/footerPagina.php"); ?>

    <!-- Cookies -->
    <section class="cookie-notice" id="cookie-notice">
        <h2>🍪 Boral - Cookies</h2>
        <p>En Boral Pastelería utilizamos cookies para garantizar que tengas la mejor experiencia en nuestro sitio web. <a href="#">Leer política de cookies</a>.</p>

        <div class="cookie-buttons">
            <button class="manage-btn">Gestiona tus preferencias</button>
            <button class="accept-btn" id="accept-btn">Aceptar</button>
        </div>
    </section>

    <script>
        if (sessionStorage.getItem('cookiesAccepted') === 'true') {
            document.getElementById('cookie-notice').style.display = 'none';
        }

        const acceptButton = document.getElementById('accept-btn');
        const cookieNotice = document.getElementById('cookie-notice');

        acceptButton.addEventListener('click', function() {
            cookieNotice.style.display = 'none';
            sessionStorage.setItem('cookiesAccepted', 'true');
        });
        
        
        
        let index = 0; // Índice de la imagen actual
        const slider = document.querySelector('.slider');
        const images = slider.querySelectorAll('img');
        const totalImages = images.length;

        // Función para cambiar las imágenes
        function changeSlide() {
            index = (index + 1) % totalImages; // Siguiente imagen (circular)
            slider.style.transform = `translateX(-${index * 350}px)`; // Mover el slider
        }

        // Cambiar imagen cada 3 segundos (3000 ms)
        setInterval(changeSlide, 3000);
        
 



    const accessToken = '7vzJSH3HGygeDfysqWtTMmEX1SzE9ezgXWkDrJtyOdyOCc9tTT1dCbwFtjeBAF4I';
    const map = L.map('map-canvas1').setView([41.6260702, -0.9142314], 16);

    // List of all our defaults styles names
    const styles = ['jawg-streets', 'jawg-dark'];
    const baselayers = {};
    // Creating one tile layers for each style
    styles.forEach((style) =>
        baselayers[style] = L.tileLayer(
            `https://tile.jawg.io/${style}/{z}/{x}/{y}.png?access-token=${accessToken}`, {
                attribution: '<a href="https://jawg.io" title="Tiles Courtesy of Jawg Maps" target="_blank" class="jawg-attrib">&copy; <b>Jawg</b>Maps</a></a>',
            }
        )
    );

    baselayers['jawg-streets'].addTo(map);
    L.control.layers(baselayers).addTo(map);

    L.marker([41.6260702, -0.9142314])
        .addTo(map)
        .bindPopup("Boral Pasteleria")
        .openPopup();


        
        
        
        
    tinymce.init({
            selector: 'textarea#descripcion',
            height: 250,  
            width: 625,  
            plugins: [
                'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
                'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
                'insertdatetime', 'media', 'table', 'wordcount'
            ],
            toolbar: 'undo redo | bold italic | alignleft aligncenter alignright | bullist numlist',
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:12px; }' 
     });
        
        
        
    const filters = document.querySelectorAll('.filter');
    const products = document.querySelectorAll('.product-item');

    filters.forEach(filter => {
        filter.addEventListener('click', () => {
            // Quitar la clase 'active' de todos los filtros
            filters.forEach(f => f.classList.remove('active'));
            filter.classList.add('active'); // Añadir la clase 'active' al filtro seleccionado
            
            const filterValue = filter.getAttribute('data-filter');
            
            // Mostrar todos los productos o solo los de la categoría seleccionada
            products.forEach(product => {
                if (filterValue === 'all' || product.getAttribute('data-category') === filterValue) {
                    product.style.display = 'block';
                } else {
                    product.style.display = 'none';
                }
            });
        });
    });
    </script>


</body>
</html>
