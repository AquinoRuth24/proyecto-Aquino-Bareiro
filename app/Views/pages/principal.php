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
            <div class="card" style="width: 190px;">

              <!-- Carrusel interno de imagenes por producto -->
              <?php if (isset($imagenes[$producto['id_producto']]) && count($imagenes[$producto['id_producto']]) > 0): ?>
                <div id="productoCarousel<?= $producto['id_producto'] ?>" class="carousel slide" data-bs-ride="carousel">
                  <div class="carousel-inner">
                    <?php foreach ($imagenes[$producto['id_producto']] as $imgIndex => $imagen): ?>
                      <div class="carousel-item <?= $imgIndex === 0 ? 'active' : '' ?>">
                        <img src="<?= base_url(relativePath: $imagen) ?>" class="d-block w-100" alt="<?= $producto['nombre'] ?>">
                      </div>
                    <?php endforeach; ?>
                  </div>

                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

    <!-- Navegación carrusel principal -->
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselProductos" data-bs-slide="prev">
      <span class="carousel-control-prev-icon bg-dark rounded-circle p-2" aria-hidden="true"></span>
      <span class="visually-hidden">Anterior</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselProductos" data-bs-slide="next">
      <span class="carousel-control-next-icon bg-dark rounded-circle p-2" aria-hidden="true"></span>
      <span class="visually-hidden">Siguiente</span>
    </button>

  </div>
</div>
</div>