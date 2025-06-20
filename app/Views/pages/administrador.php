
<nav class="navbar navbar-expand-lg navbar-dark" style="background: linear-gradient(to right, #0f0c29, #302b63, #24243e);">
    <div class="container-fluid">
        <img src="public/assets/img/marca.jpg" alt="Logo" height="60" class="me-2">
        <a class="navbar-brand fw-bold" href="#">ADMIN</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarAdmin"
            aria-controls="navbarAdmin" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarAdmin">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="#">CRUD Usuarios</a></li>
                <li class="nav-item"><a class="nav-link" href="#">CRUD Productos</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Ventas</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Consultas</a></li>
            </ul>
            <ul class="navbar-nav ms-auto">
                <span class="navbar-text text-white me-3">Usuario: admin</span>
                <li class="nav-item">
                    <a class="btn btn-outline-light" href="#">Cerrar sesión</a>
                </li>
            </ul>
        </div>
    </div>
</nav>




<div class="container mt-4">
    <div class="d-flex justify-content-between mb-3">
        <h2>Productos</h2>
        <div>
            <a href="<?= site_url('producto/crearProducto') ?>" class="btn btn-success">Agregar</a>
            <a href="<?= site_url('producto/productosEliminados') ?>" class="btn btn-danger">Eliminados</a>
        </div>
    </div>

    <table class="table table-bordered table-hover">
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>Producto</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Imagen</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($productos as $producto): ?>
                <tr>
                    <td><?= esc($producto['id_producto']) ?></td>
                    <td><?= esc($producto['nombre']) ?></td>
                    <td><?= number_format($producto['precio'], 2) ?></td>
                    <td><?= esc($producto['stock']) ?></td>
                    <?php $img = $imagenes[$producto['id_producto']][0] ?? null; ?>
                    <td>
                        <?php if ($img): ?>
                            <img src="<?= base_url($img) ?>" alt="Imagen" width="50">
                        <?php else: ?>
                            Sin imagen
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="<?= site_url('producto/editarProducto/' . $producto['id_producto']) ?>"
                            class="btn btn-primary btn-sm">Editar</a>
                        <a href="<?= site_url('producto/eliminarProducto/' . $producto['id_producto']) ?>"
                            class="btn btn-secondary btn-sm">Borrar</a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>