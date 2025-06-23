<head>
    <title>Responder A Consultas</title>
    <link href="<?= base_url('public/assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('public/assets/css/miestilo.css') ?>" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="icon" href="<?= base_url('public/assets/img/marca.ico') ?>" type="image/x-icon">

</head>
<div class="container mt-4 p-3 rounded" style="background-color: darkgray;">
    <div class="d-flex justify-content-between align-items-center position-relative">
        <div style="width: 150px;"></div>
        <h2 class="mb-0 text-center flex-grow-1">Responder A Consultas</h2>
        <a href="<?= site_url('administrador') ?>" class="btn btn-primary">
            <i class="bi bi-arrow-left-circle"></i> Volver
        </a>
    </div>
</div>
<div class="container mt-4">
    <div class="mb-3">
        <strong>Mensaje:</strong><br>
        <?= esc($consulta['mensaje']) ?>
    </div>

    <form method="post" action="<?= site_url('consultas/responder/' . $consulta['id_consulta']) ?>">
        <div class="mb-3">
            <label for="respuesta" class="form-label">Respuesta:</label>
            <textarea name="respuesta" id="respuesta" class="form-control" rows="5" required><?= esc($consulta['respuesta']) ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Enviar respuesta</button>
        <a href="<?= site_url('admin/consultas') ?>" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
<script src="<?= base_url('public/assets/js/bootstrap.js') ?>"></script>