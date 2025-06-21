<head>
    <meta charset="UTF-8">
    <title>Ventas Realizadas</title>
    <link href="<?= base_url('public/assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('public/assets/css/miestilo.css') ?>" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>

<div class="container mt-5">
    <h2 class="mb-4"><i class="bi bi-cart-check"></i> Gestión de Ventas</h2>

    <table class="table table-bordered table-striped table-hover text-center">
        <thead class="table-primary">
            <tr>
                <th>ID Venta</th>
                <th>Fecha</th>
                <th>Detalle</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($ventas as $venta): ?>
                <tr>
                    <td><?= $venta['id'] ?></td>
                    <td><?= $venta['fecha'] ?></td>
                    <td class="text-start">
                        <ul class="mb-0">
                            <?php foreach ($venta['detalles'] as $detalle): ?>
                                <li>
                                    <strong><?= esc($detalle['producto']) ?></strong> |
                                    Cant: <?= $detalle['cantidad'] ?> |
                                    Precio: $<?= $detalle['precio_unitario'] ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </td>
                    <td>
                        $<?= number_format($venta['total'], 2, ',', '.') ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script src="<?= base_url('public/assets/js/bootstrap.min.js') ?>"></script>

