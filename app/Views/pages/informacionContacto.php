<section class="hero">
    <!-- encabezado de la seccion -->
    <h1>Información de Contacto</h1>
    <ul class="list-unstyled">
        <li>En esta sección encontrarás información sobre cómo contactarnos y resolver tus dudas.</li>
        <li>Si tienes alguna pregunta o inquietud, no dudes en ponerte en contacto con nosotros!</li>
    </ul>
</section>

<div class="container mt-4">
    <div class="row g-4">

        <!-- Donde encontrarnos -->
        <div class="col-md-6">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title"><strong>Donde Encontrarnos!</strong></h5>
                    <ul class="list-unstyled">
                        <li>📍🌍Direccion fisica:</li>
                        <li style="padding-left: 2rem;">9 de julio 1453,Corrientes,Corrientes,Argentina</li>
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3540.0845020903835!2d-58.832228300000004!3d-27.4666285!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94456ca6d2fe84f1%3A0x50733ca264735ee3!2s9%20de%20Julio%201453%2C%20W3400AZB%20Corrientes!5e0!3m2!1ses-419!2sar!4v1745638597802!5m2!1ses-419!2sar"
                            width="400" height="200" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Como contactarnos -->
        <div class="col-md-6">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title"><strong>¿Cómo contactarnos?</strong></h5>
                    <ul class="list-unstyled">
                        <li style="margin-top: 1rem;"> <img src="public/assets/img/instagram.jpg" alt="Instagram"
                                height="40">Instagram: <a href="https://www.instagram.com/yesi_yohi.store"
                                target="_blank">@yesi_yohi.store</a></li>
                        <li style="margin-top: 1rem;">Contacto: Bareiro Angel Andres:</li>
                        <li style="padding-left: 2rem;"><img src="public/assets/img/logoWpp.jpg" alt="Whatsapp"
                                height="40">: <a href="tel:+54 9 3795-103530">+54 9 3795-103530</a></li>
                        <li>📧Email: <a href="mailto:andres.bareiro@outlook.com">andres.bareiro@outlook.com</a></li>
                        <li style="margin-top: 1rem;">Contacto: Aquino Ruth:</li>
                        <li style="padding-left: 2rem;"><img src="public/assets/img/logoWpp.jpg" alt="Whatsapp"
                                height="40">: <a href="tel:+54 9 379 480-0790">+54 9 379 480-0790</a></li>
                        <li>📧Email: <a href="mailto:ruth.aquino@outlook.com">aquinoruth2004@gmail.com</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Formulario de consultas -->
<section class="formulario">
    <h2 style="margin-top: 2rem; text-align: center;">Formulario de Consultas</h2>
    <?php if (session()->getFlashdata('mensaje')): ?>
    <div class="alert alert-success">
        <?= session()->getFlashdata('mensaje') ?>
    </div>
    <?php endif; ?>

    <form action="<?= base_url('enviar/consulta') ?>" method="post" style="max-width: 600px; margin: auto;">
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
            <label for="telefono" class="form-label">Teléfono</label>
            <input type="tel" class="form-control" id="telefono" name="telefono" required pattern="[0-9]{10}"
                title="Número de teléfono válido de 10 dígitos" placeholder="Ej: 3794222684">
        </div>
        <div class="mb-3">
            <label for="mensaje" class="form-label">Mensaje</label>
            <textarea class="form-control" id="mensaje" name="mensaje" rows="5" required minlength="10" maxlength="1000"
                title="el mensaje debe tener al menos 10 caracteres"
                placeholder="Escribe tu mensaje aquí..."></textarea>
        </div>
        <button type="submit" class="btn btn-success">Enviar consulta</button>
    </form>

</section>