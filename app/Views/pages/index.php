<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <div class="d-flex justify-content-between mb-3">
        <h2>Productos</h2>
        <div>
            <a href="<?= site_url('producto/crearProducto') ?>" class="btn btn-success">Agregar</a>
            <a href="<?= site_url('producto/productosEliminados') ?>" class="btn btn-danger">Eliminados</a>
        </div>
    </div>

    <table class="table table-bordered table-hover">
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>Producto</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Imagen</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($productos as $producto): ?>
                <tr>
                    <td><?= esc($producto['id_producto']) ?></td>
                    <td><?= esc($producto['nombre']) ?></td>
                    <td>$<?= number_format($producto['precio'], 2) ?></td>
                    <td><?= esc($producto['stock']) ?></td>
                    <td>
                        <?php if (!empty($imagenes[$producto['id_producto']])): ?>
                            <img src="<?= base_url($imagenes[$producto['id_producto']][0]) ?>" width="50" class="rounded">
                        <?php else: ?>
                            <span class="text-muted">Sin imagen</span>
                        <?php endif ?>
                    </td>
                    <td>
                        <a href="<?= site_url('producto/editarProducto/' . $producto['id_producto']) ?>" class="btn btn-sm btn-primary">Editar</a>
                        <a href="<?= site_url('producto/eliminarProducto/' . $producto['id_producto']) ?>" class="btn btn-sm btn-secondary">Borrar</a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>

<?= $this->endSection() ?>
