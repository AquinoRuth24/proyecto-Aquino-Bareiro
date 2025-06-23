<head>
    <title>Productos</title>
    <link href="<?= base_url('public/assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('public/assets/css/miestilo.css') ?>" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<!-- Estilos DataTables -->
<link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success">
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>

<div class="container mt-4">
    <div class="d-flex justify-content-between mb-3">
        <h2>Productos</h2>
        <div>
            <a href="<?= site_url('producto/crearProducto') ?>" class="btn btn-success">Agregar</a>
            <a href="<?= site_url('producto/productosEliminados') ?>" class="btn btn-danger">Eliminados</a>
        </div>
    </div>

    <table id="tabla-productos" class="table table-striped table-bordered">
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
                            <img src="<?= base_url('public/assets/img/' . $imagenes[$producto['id_producto']][0]) ?>" width="50" class="rounded">
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

<!-- Scripts de DataTables -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function() {
        $('#tabla-productos').DataTable({
            language: {
                url: "<?= base_url('public/assets/i18n/es-ES.json') ?>"
            }
        });
    });
</script>
<script src="<?= base_url('public/assets/js/bootstrap.js') ?>"></script>