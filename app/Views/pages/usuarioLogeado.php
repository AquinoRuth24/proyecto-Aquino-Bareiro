<h2>Bienvenido, <?= esc(session('nombre')) ?>!</h2>
<p>Gracias por iniciar sesión en Yesi Yohi Store.</p>

<?php if(session()->getFlashdata('message')): ?>
    <div class="alert alert-success"><?= session()->getFlashdata('message') ?></div>
<?php endif; ?>

<div class="card mt-4" style="max-width: 500px;">
    <div class="card-header bg-primary text-white">
        Información de usuario
    </div>
    <div class="card-body">
        <p><strong>Nombre:</strong> <?= esc(session('nombre')) ?></p>
        <p><strong>Email:</strong> <?= esc(session('email')) ?></p>
        <p><strong>Teléfono:</strong> <?= esc(session('telefono')) ?></p>
    </div>
</div>
