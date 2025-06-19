<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h2>Editar Producto</h2>
    <?php if (isset($validation)): ?>
        <div class="alert alert-danger">
            <?= $validation->listErrors() ?>
        </div>
    <?php endif; ?>

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

<?= $this->endSection() ?>