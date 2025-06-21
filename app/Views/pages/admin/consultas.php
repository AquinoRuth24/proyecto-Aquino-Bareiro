<head>
    <title>Productos</title>
    <link href="<?= base_url('public/assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('public/assets/css/miestilo.css') ?>" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<div class="container mt-4">
    <h2>Consultas de Usuarios</h2>

    <?php if (session()->getFlashdata('mensaje')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('mensaje') ?></div>
    <?php endif ?>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Nombre</th>
                <th>Email</th>
                <th>Mensaje</th>
                <th>Fecha</th>
                <th>Estado</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($consultas as $consulta): ?>
                <tr>
                    <td><?= esc($consulta['usuario_nombre'] ?? $consulta['nombre']) ?></td>
                    <td><?= esc($consulta['usuario_email'] ?? $consulta['email']) ?></td>
                    <td><?= esc($consulta['mensaje']) ?></td>
                    <td><?= esc($consulta['fecha_envio']) ?></td>
                    <td>
                        <?php if ($consulta['contestado']): ?>
                            <span class="badge bg-success">Contestado</span>
                        <?php else: ?>
                            <span class="badge bg-warning text-dark">Pendiente</span>
                        <?php endif ?>
                    </td>
                    <td>
                        <?php if (!$consulta['contestado']): ?>
                            <a href="<?= site_url('consultas/responder/' . $consulta['id_consulta']) ?>" class="btn btn-sm btn-success">
                                Responder
                            </a>
                        <?php else: ?>
                            <em>Ya respondida</em>
                        <?php endif ?>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>
<script src="<?= base_url('public/assets/js/bootstrap.js') ?>"></script>