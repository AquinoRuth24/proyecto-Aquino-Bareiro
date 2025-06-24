<!-- Sección hero -->
<section class="hero" id="inicio">
    <h1>Bienvenido a nuestra tienda</h1>
    <p>Encontrá ropa moderna, cómoda y de calidad.</p>
</section>

<!-- Productos -->
<div class="container mt-5">
    <div class="border rounded shadow p-4 bg-white">
        <h4 class="mb-4 text-center">Productos destacados</h4>

        <div id="carouselProductos" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">

                <?php foreach ($productos as $index => $producto): ?>
                    <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                        <div class="d-flex justify-content-center">
                            <div class="card" style="width: 250px;">

                                <!-- Galería de imágenes -->
                                <?php if (!empty($imagenes[$producto['id_producto']])): ?>
                                    <div class="d-flex flex-wrap justify-content-center">
                                        <?php foreach ($imagenes[$producto['id_producto']] as $imgIndex => $imagen): ?>
                                            <img src="<?= base_url($imagen) ?>" class="m-1 border rounded"
                                                alt="<?= $producto['nombre'] ?>"
                                                style="width: 120px; height: 120px; object-fit: cover; cursor: zoom-in;"
                                                onclick="abrirGaleria(<?= htmlspecialchars(json_encode(array_map('base_url', $imagenes[$producto['id_producto']]))); ?>, <?= $imgIndex ?>)">
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>

                                <div class="card-body text-center">
                                    <h6 class="card-title"><?= esc($producto['nombre']) ?></h6>
                                </div>

                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>

            <!-- Controles carrusel principal -->
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselProductos"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon bg-dark rounded-circle p-2" aria-hidden="true"></span>
                <span class="visually-hidden">Anterior</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselProductos"
                data-bs-slide="next">
                <span class="carousel-control-next-icon bg-dark rounded-circle p-2" aria-hidden="true"></span>
                <span class="visually-hidden">Siguiente</span>
            </button>
        </div>
    </div>
</div>

<!-- Modal galería -->
<div class="modal fade" id="imagenModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content bg-dark position-relative">
            <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-3"
                data-bs-dismiss="modal" aria-label="Close"></button>

            <div class="modal-body text-center p-0">
                <img id="imagenModalSrc" src="" class="img-fluid" style="max-height: 90vh;">
            </div>

            <!-- Botones de navegación -->
            <button class="btn btn-dark position-absolute top-50 start-0 translate-middle-y" onclick="cambiarImagen(-1)"
                style="z-index: 1055;">
                ‹
            </button>
            <button class="btn btn-dark position-absolute top-50 end-0 translate-middle-y" onclick="cambiarImagen(1)"
                style="z-index: 1055;">
                ›
            </button>
        </div>
    </div>
</div>

<!-- Script para galería -->
<script>
    let galeriaActual = [];
    let indiceActual = 0;

    function abrirGaleria(imagenes, indice) {
        galeriaActual = imagenes;
        indiceActual = indice;
        mostrarImagen();
        const modal = new bootstrap.Modal(document.getElementById('imagenModal'));
        modal.show();
    }

    function mostrarImagen() {
        const img = document.getElementById('imagenModalSrc');
        img.src = galeriaActual[indiceActual];
    }

    function cambiarImagen(direccion) {
        indiceActual += direccion;
        if (indiceActual < 0) indiceActual = galeriaActual.length - 1;
        if (indiceActual >= galeriaActual.length) indiceActual = 0;
        mostrarImagen();
    }
</script>