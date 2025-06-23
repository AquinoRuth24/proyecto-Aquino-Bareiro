<head>
    <meta charset="UTF-8">
    <title>Ventas Realizadas</title>
    <link href="<?= base_url('public/assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('public/assets/css/miestilo.css') ?>" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="icon" href="<?= base_url('public/assets/img/marca.ico') ?>" type="image/x-icon">
</head>
<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark"
    style="background: linear-gradient(to right, #0f0c29, #302b63, #24243e);">
    <div class="container-fluid">
        <img src="<?= base_url('public/assets/img/marca.jpg') ?>" alt="Logo" height="60" class="me-2">
        <a class="navbar-brand fw-bold" href="#">ADMIN</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarAdmin"
            aria-controls="navbarAdmin" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarAdmin">
            <ul class="navbar-nav me-auto d-flex flex-row">
                <li class="nav-item me-3">
                    <a class="nav-link" href="<?= site_url('principal') ?>">Home</a>
                </li>
                <li class="nav-item me-3">
                    <a class="nav-link" href="<?= site_url('usuario') ?>">Usuarios</a>
                </li>
                <li class="nav-item me-3">
                    <a class="nav-link" href="<?= site_url('producto') ?>">Productos</a>
                </li>
                <li class="nav-item me-3">
                    <a class="nav-link" href="<?= site_url('admin/ventas') ?>">Ventas</a>
                </li>
                <li class="nav-item me-3">
                    <a class="nav-link" href="<?= site_url('admin/consultas') ?>">Consultas</a>
                </li>
                <li class="nav-item me-3">
                    <a class="nav-link" href="<?= site_url('admin/facturas') ?>">Facturas</a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto d-flex align-items-center flex-row">
                <span class="navbar-text text-white me-3">
                    Usuario: <?= session('usuario') ?? 'admin' ?>
                </span>
                <li class="nav-item">
                    <a class="btn btn-outline-light" href="<?= site_url('logout') ?>">Cerrar sesión</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
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