<head>
    <meta charset="UTF-8">
    <title>Ventas Realizadas</title>
    <link href="<?= base_url('public/assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('public/assets/css/miestilo.css') ?>" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>

<h2>Facturas de compras</h2>
<div class="container mt-4">
    <h2 class="mb-4">Facturas del Día</h2>

    <!-- FILTROS -->
    <form method="get" class="row g-3 mb-4">
        <div class="col-md-4">
            <label class="form-label">Fecha</label>
            <input type="date" name="fecha" class="form-control" value="<?= esc($fecha) ?>">
        </div>

        <div class="col-md-4">
            <label class="form-label">Cliente</label>
            <select name="cliente" class="form-select">
                <option value="">Todos</option>
                <?php foreach ($usuarios as $usuario): ?>
                    <option value="<?= $usuario['id_usuario'] ?>" <?= $clienteSeleccionado == $usuario['id_usuario'] ? 'selected' : '' ?>>
                        <?= esc($usuario['nombre']) ?> (<?= esc($usuario['email']) ?>)
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="col-md-4 d-flex align-items-end">
            <button type="submit" class="btn btn-primary w-100">Filtrar</button>
        </div>
    </form>
</div>

<?php foreach ($cabeceras as $cabecera): ?>
    <div class="card mb-4">
        <div class="card-header bg-dark text-white">
            Factura N° <?= $cabecera['id_cabecera'] ?> | Usuario: <?= $cabecera['usuario']['usuario'] ?? 'Desconocido' ?> | Fecha: <?= $cabecera['fecha_creacion'] ?>
        </div>
        <div class="card-body">
            <ul>
                <?php foreach ($cabecera['facturas'] as $factura): ?>
                    <li>
                        <?= $factura['producto'] ?> - Cantidad: <?= $factura['cantidad'] ?> - Precio: $<?= $factura['precio_unitario'] ?> - Subtotal: $<?= $factura['subtotal'] ?>
                    </li>
                <?php endforeach; ?>
            </ul>
            <div class="text-end fw-bold">
                Total: $<?= $cabecera['precio_total'] ?>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<script src="<?= base_url('public/assets/js/bootstrap.min.js') ?>"></script>