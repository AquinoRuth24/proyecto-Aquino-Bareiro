<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h2>Crear Producto</h2>
    <p>Complete el siguiente formulario para agregar un nuevo producto.</p>
</div>
<div class="container mt-4">
    <?php if (isset($validation)): ?>
        <div class="alert alert-danger">
            <?= $validation->listErrors() ?>
        </div>
    <?php endif; ?>
</div>
<form action="<?= site_url('producto/crearProducto') ?>" method="post" enctype="multipart/form-data">
    <div class="mb-3">
        <label>Nombre:</label>
        <input type="text" name="nombre" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Descripción:</label>
        <textarea name="descripcion" class="form-control" required></textarea>
    </div>
    <div class="mb-3">
        <label>Precio:</label>
        <input type="number" name="precio" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Stock:</label>
        <input type="number" name="stock" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Imagen principal:</label>
        <input type="file" name="imagen" class="form-control" accept="image/*" required>
    </div>
    <button type="submit" class="btn btn-success">Guardar</button>
    <a href="<?= site_url('producto') ?>" class="btn btn-secondary">Cancelar</a>
</form>

<?= $this->endSection() ?>