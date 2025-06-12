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
              <div class="card" style="width: 18rem;">
                <img src="<?= base_url($producto['url_imagen']) ?>" class="card-img-top" alt="<?= $producto['descripcion'] ?>">
                <div class="card-body text-center">
                  <h5 class="card-title"><?= $producto['descripcion'] ?></h5>
                  <p class="card-text">$<?= number_format((float)$producto['precio'], 2, ',', '.') ?></p>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>

      <!-- FLECHAS DE NAVEGACIÓN -->
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