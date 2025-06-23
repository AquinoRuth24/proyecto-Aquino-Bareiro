<head>
    <title>Productos</title>
    <link href="<?= base_url('public/assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('public/assets/css/miestilo.css') ?>" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>

<div class="container mt-4;" style="text-align: center;">
    <h1>Editar Producto</h1>
</div>
<?php if (isset($validation)): ?>
    <div class="alert alert-danger">
        <?= $validation->listErrors() ?>
    </div>
<?php endif; ?>
<div style="   margin-left: 60;margin-right: auto; ">
    <form action="<?= site_url('producto/editarProducto/' . $producto['id_producto']) ?>" method="post" enctype="multipart/form-data">
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
    </form>
</div>
<script src="<?= base_url('public/assets/js/bootstrap.js') ?>"></script>