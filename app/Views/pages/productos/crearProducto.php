<head>
    <title>Productos</title>
    <link href="<?= base_url('public/assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('public/assets/css/miestilo.css') ?>" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>

<div class="container mt-4" style="background-color:darkgray;">
    <h2 class="text-center mb-3">Crear Producto</h2>
</div>

<form action="<?= site_url('producto/crearProducto') ?>" method="post" enctype="multipart/form-data">
    <div class="crearProducto">
        <div class="mb-3">
            <label class="form-label">Nombre:</label>
            <input type="text" name="nombre" class="form-control" placeholder="Ej: Remera blanca" style="color: black;"required>
        </div>
        <div class="mb-3">
            <label class="form-label">Descripción:</label>
            <textarea name="descripcion" class="form-control" rows="3" required></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Precio:</label>
            <input type="number" name="precio" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Stock:</label>
            <input type="number" name="stock" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Imagen principal:</label>
            <input type="file" name="imagen" class="form-control" accept="image/*" required>
        </div>
        <div class="d-flex justify-content-between">
            <button type="submit" class="btn btn-success">
                <i class="bi bi-check-circle"></i> Guardar
            </button>
            <a href="<?= site_url('producto') ?>" class="btn btn-secondary">
                <i class="bi bi-x-circle"></i> Cancelar
            </a>
        </div>
    </div>
</form>


<script src="<?= base_url('public/assets/js/bootstrap.js') ?>"></script>