<div class="container mt-4">
    <h2>Mis Consultas</h2>

    <?php if (empty($consultas)): ?>
        <div class="alert alert-info">No has enviado ninguna consulta aún.</div>
    <?php else: ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Mensaje</th>
                    <th>Fecha</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($consultas as $consulta): ?>
                    <tr>
                        <td><?= esc($consulta['mensaje']) ?></td>
                        <td><?= esc($consulta['fecha_envio']) ?></td>
                        <td>
                            <?php if ($consulta['contestado']): ?>
                                <span class="badge bg-success">Respondida</span>
                            <?php else: ?>
                                <span class="badge bg-warning text-dark">Pendiente</span>
                            <?php endif ?>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    <?php endif ?>
</div>
