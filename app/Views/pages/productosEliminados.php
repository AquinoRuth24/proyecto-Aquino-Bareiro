<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-4">
    <h2>Productos Eliminados</h2>
    <a href="<?= site_url('producto') ?>" class="btn btn-primary mb-3">Volver</a>

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($productos as $producto): ?>
                <tr>
                    <td><?= $producto['id_producto'] ?></td>
                    <td><?= esc($producto['nombre']) ?></td>
                    <td>
                        <a href="<?= site_url('producto/restaurarProducto/' . $producto['id_producto']) ?>" class="btn btn-success btn-sm">Restaurar</a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>

<?= $this->endSection() ?>
