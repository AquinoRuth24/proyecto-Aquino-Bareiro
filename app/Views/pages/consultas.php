<section class="hero">
    <h1>Consultas</h1>
</section>
<!-- Formulario de consulta -->
<section class="formulario">
    <h2 style="margin-top: 2rem; text-align: center;">Formulario de Consultas</h2>
    <?php if (session()->getFlashdata('mensaje')): ?>
    <div class="alert alert-success">
        <?= session()->getFlashdata('mensaje') ?>
    </div>
    <?php endif; ?>

    <form action="<?= base_url('/consultas/enviar') ?>" method="post" style="max-width: 600px; margin: auto;">
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre completo</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required minlength="3" maxlength="50"
                title="Nombre completo" pattern="^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$" placeholder="Ej: María López">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Correo electrónico</label>
            <input type="email" class="form-control" id="email" name="email" required title="email valido"
                pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" maxlength="50" minlength="10"
                placeholder="Ej: lucas.beltran@gmail.com">
        </div>
        <div class="mb-3">
            <label for="mensaje" class="form-label">Consulta</label>
            <textarea class="form-control" id="mensaje" name="mensaje" rows="5" required minlength="10" maxlength="1000"
                title="el mensaje debe tener al menos 10 caracteres"
                placeholder="Escribe tu mensaje aquí..."></textarea>
        </div>
        <button type="submit" class="btn btn-success">Enviar Consulta</button>
    </form>
