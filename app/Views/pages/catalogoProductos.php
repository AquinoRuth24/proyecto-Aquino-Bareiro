<section class="hero">
    <h1>Catalogo De Productos</h1>
</section>

<div class="container mt-5">
    <h2>Catálogo de Productos</h2>

    <!-- FORMULARIO DE FILTRO -->
    <form method="get" action="<?= site_url('catalogoProductos') ?>" class="row g-3 mb-4">
        <div class="col-md-4">
            <input type="text" name="nombre" class="form-control" placeholder="Nombre del producto" value="<?= esc($filtros['nombre'] ?? '') ?>">
        </div>
        <div class="col-md-3">
            <select name="categoria" class="form-select">
                <option value="">Todas las categorías</option>
                <?php foreach ($categorias as $cat): ?>
                    <option value="<?= $cat['id_categoria'] ?>" <?= ($filtros['categoria'] ?? '') == $cat['id_categoria'] ? 'selected' : '' ?>>
                        <?= esc($cat['nombre']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-2">
            <input type="number" name="precio_min" class="form-control" placeholder="Precio mínimo" value="<?= esc($filtros['precio_min'] ?? '') ?>">
        </div>
        <div class="col-md-2">
            <input type="number" name="precio_max" class="form-control" placeholder="Precio máximo" value="<?= esc($filtros['precio_max'] ?? '') ?>">
        </div>
        <div class="col-md-1">
            <button type="submit" class="btn btn-primary w-100"><i class="bi bi-search"></i></button>
        </div>
    </form>

    <!-- MAPEO PARA MOSTRAR NOMBRE DE LA CATEGORÍA -->
    <?php
    $categoriasMap = [];
    foreach ($categorias as $cat) {
        $categoriasMap[$cat['id_categoria']] = $cat['nombre'];
    }
    ?>

    <!-- PRODUCTOS -->
    <div class="row">
        <?php foreach ($productos as $prod): ?>
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <img src="<?= base_url('uploads/' . esc($prod['url_imagen'] ?? 'default.jpg')) ?>" class="card-img-top" alt="<?= esc($prod['nombre']) ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?= esc($prod['nombre']) ?></h5>
                        <p class="card-text">Precio: $<?= esc($prod['precio']) ?></p>
                        <p class="card-text">
                            Categoría: <?= esc($categoriasMap[$prod['id_categoria']] ?? 'Sin categoría') ?>
                        </p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>