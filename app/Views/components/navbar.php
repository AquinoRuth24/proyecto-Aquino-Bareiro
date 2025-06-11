<?php
$actualMethod = service('router')->methodName();
?>

<nav class="navbar navbar-expand-lg navbar-dark" style="background-color:rgb(0, 0, 0);">
    <div class="container-fluid">
        <img src="public/assets/img/marca.jpg" alt="" height="80">
        <a class="navbar-brand" href="<?= base_url() ?>">Yesi Yohi Store</a>

        <!-- Botón hamburguesa -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Opciones del menú -->
        <div class="collapse navbar-collapse shadow" id="navbarNav" style="background-color:rgb(39, 38, 39);">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link <?= ($actualMethod === 'index') ? 'active text-success' : '' ?>"
                        href="<?= base_url() ?>">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($actualMethod === 'quienesSomos') ? 'active text-success' : '' ?>"
                        href="<?= base_url('quienesSomos') ?>">Quienes Somos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($actualMethod === 'informacionContacto') ? 'active text-success' : '' ?>"
                        href="<?= base_url('informacionContacto') ?>">Contacto</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($actualMethod === 'comercializacion') ? 'active text-success' : '' ?>"
                        href="<?= base_url('comercializacion') ?>">Comercializacion</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($actualMethod === 'terminosYUsos') ? 'active text-success' : '' ?>"
                        href="<?= base_url('terminosYUsos') ?>">Términos y usos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link  <?= ($actualMethod === 'catalogoProductos') ? 'active text-success' : '' ?>"
                        href="<?= base_url('catalogoProductos') ?>">Catalago</a>
                </li>
                <!-- Mostrar "Consultas" solo si el usuario está logueado -->
                <?php if (session()->get('isLoggedIn')): ?>
                <li class="nav-item">
                    <a class="nav-link  <?= ($actualMethod === 'consultas') ? 'active text-success' : '' ?>"
                        href="<?= base_url('consultas') ?>">Consultas</a>
                </li>
                <?php endif; ?>
            </ul>

            <!-- Íconos de usuario y carrito -->
            <ul class="navbar-nav ms-auto"><!--ms-auto alinea a la derecha-->
                <li class="nav-item">
                    <a class="nav-link text-white" href="<?= base_url('carrito') ?>">
                        <i class="bi bi-cart-fill"></i>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link text-white" href="<?= base_url('login') ?>">
                        <i class="bi bi-person-circle"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Script para cerrar el menú automatico en celular -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var navbarCollapse = document.getElementById('navbarNav');
        var navLinks = document.querySelectorAll('.nav-link');

        navLinks.forEach(function(link) {
            link.addEventListener('click', function() {
                if (window.innerWidth < 992) {
                    var collapse = new bootstrap.Collapse(navbarCollapse, {
                        toggle: false
                    });
                    collapse.hide();
                }
            });
        });
    });
</script>