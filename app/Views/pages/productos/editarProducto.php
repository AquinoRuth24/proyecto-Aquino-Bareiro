<head>
    <title>Editar Productos</title>
    <link href="<?= base_url('public/assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('public/assets/css/miestilo.css') ?>" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="icon" href="<?= base_url('public/assets/img/marca.ico') ?>" type="image/x-icon">
</head>

<?php if (isset($validation)): ?>
    <div class="alert alert-danger">
        <?= $validation->listErrors() ?>
    </div>
<?php endif; ?>
<<div class="container mt-4 p-3 rounded" style="background-color: darkgray;">
    <div class="d-flex justify-content-between align-items-center position-relative">
        <div style="width: 150px;"></div>
        <h2 class="mb-0 text-center flex-grow-1">Editar Un Producto</h2>
        <a href="<?= site_url('producto') ?>" class="btn btn-primary">
            <i class="bi bi-arrow-left-circle"></i> Volver
        </a>
    </div>
</div>

<from action="<?= site_url('producto/editarProducto/' . $producto['id_producto']) ?>" method="POST" enctype="multipart/form-data">
    <div class="crearProducto">
        <div class="mb-3">
            <label>Nombre:</label>
            <input type="text" name="nombre" class="form-control" value="<?= esc($producto['nombre']) ?>" required>
        </div>
        <div class="mb-3">
            <label>Descripción:</label>
            <textarea name="descripcion" class="form-control" required><?= esc($producto['descripcion']) ?></textarea>
        </div>
        <div class="mb-3">
            <label>Precio:</label>
            <input type="number" name="precio" class="form-control" value="<?= esc($producto['precio']) ?>" required>
        </div>
        <div class="mb-3">
            <label>Stock:</label>
            <input type="number" name="stock" class="form-control" value="<?= esc($producto['stock']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="id_categoria" class="form-label">Categoría</label>
            <select name="id_categoria" class="form-select">
                <option value="">Seleccione categoría</option>
                <?php foreach ($categorias as $categoria): ?>
                    <option value="<?= $categoria['id_categoria'] ?>" <?= set_value('id_categoria', $producto['id_categoria']) == $categoria['id_categoria'] ? 'selected' : '' ?>>
                        <?= esc($categoria['nombre']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label>Imagen nueva (opcional):</label>
            <input type="file" name="imagen" class="form-control" accept="image/*">
        </div>
        <?php if (!empty($imagenActual)): ?>
            <div class="mb-3">
                <label>Imagen actual:</label><br>
                <img src="<?= base_url($imagenActual) ?>" width="100" class="rounded border">
            </div>
        <?php endif ?>
        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="<?= site_url('producto') ?>" class="btn btn-secondary">Cancelar</a>
    </div>
    </form>

    <script src="<?= base_url('public/assets/js/bootstrap.js') ?>"></script>