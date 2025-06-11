<!DOCTYPE html>
<html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= $title ?></title>
        <link href="public/assets/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="public/assets/css/miestilo.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
        <link rel="icon" href="public/assets/img/marca.ico" type="image/x-icon">
    </head>

    <body>
        <div class="wrapper">

            <header>
                <?= view("components/navbar") ?>
            </header>

            <main>
                <?= $content ?? '' ?>
            </main>

            <footer>
                <?= view("components/footer") ?>
            </footer>

        </div>

        <script src="public/assets/js/bootstrap.js"></script>

    </body>

</html>