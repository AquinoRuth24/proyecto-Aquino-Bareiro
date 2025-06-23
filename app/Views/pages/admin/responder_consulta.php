<head>
    <title>Productos</title>
    <link href="<?= base_url('public/assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('public/assets/css/miestilo.css') ?>" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="icon" href="<?= base_url('public/assets/img/marca.ico') ?>" type="image/x-icon">
</head>
<div class="container mt-4">
    <h2>Responder Consulta</h2>

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