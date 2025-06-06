<section class="registrar">
    <h1>Registro de Usuario</h1>
    <p>Por favor, complete el siguiente formulario para registrarse.</p>
</section>
<!--<form action="<?= base_url('registrar/usuario') ?>
    <?php if (session()->getFlashdata('mensaje')): ?>
    <div class="alert alert-success">
        <?= session()->getFlashdata('mensaje') ?>
    </div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger">
        <?= session()->getFlashdata('error') ?>
    </div>
    <?php endif; ?>
    <form action="<?= base_url('registrar/usuario') ?>" method="post">
</form>-->
<form>
    <div class="formularioRegistro">
        <div class="container mt-4">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre completo</label>
                <input type="text" class="form-control border border-dark" id="nombre" name="nombre" required minlength="3" maxlength="50"
                    title="Nombre completo" pattern="^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$" placeholder="Ej: María López">
            </div>
            <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="tel" class="form-control border border-dark" id="telefono" name="telefono" required pattern="[0-9]{10}"
                    title="Número de teléfono válido de 10 dígitos" placeholder="Ej: 3794222684">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Correo electrónico</label>
                <input type="email" class="form-control border border-dark" id="email" name="email" required title="email valido"
                    pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" maxlength="50" minlength="10"
                    placeholder="Ej: lucas.beltran@gmail.com">
            </div>
            <div>
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" class="form-control border border-dark" id="password" name="password" required minlength="6"
                    maxlength="20" title="La password debe tener entre 6 y 20 caracteres"
                    placeholder="Ingrese una password segura">
            </div>
            <div class="mb-3">
                <label for="confirmar_password" class="form-label">Confirmar Contraseña</label>
                <input type="password" class="form-control border border-dark" id="confirmar_password" name="confirmar_password"
                    required minlength="6" maxlength="20" title="La password debe tener entre 6 y 20 caracteres"
                    placeholder="Confirma tu password">
            </div>
            <button type="submit" class="btn btn-primary">Registrar</button>
        </div>
    </div>
</form>