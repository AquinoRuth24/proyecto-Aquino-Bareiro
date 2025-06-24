<?= $this->extend('templates/main-layout') ?>

<?= $this->section('contenido') ?>
<div class="gracias-container">
    <img src="<?= base_url('public/assets/img/graciasPorSuCompra.png') ?>" alt="Gracias por tu compra">

    <h3 class="text-success mb-4">¡Tu pedido fue procesado con éxito!</h3>

    <p>Gracias por confiar en <strong>Yesi Yohi Store</strong>.</p>
    <p>Te enviamos un correo con los detalles de la compra.</p>
    <p>Si tenés alguna pregunta, podés contactarnos desde la sección de consultas.</p>

    <hr class="my-4">

    <p>¡Esperamos verte nuevamente pronto!</p>

    <a href="<?= base_url('/catalogoProductos') ?>" class="btn btn-primary mt-3">
        Volver al catálogo
    </a>
</div>
<?= $this->endSection() ?>