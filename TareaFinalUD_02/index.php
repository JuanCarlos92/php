<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplicación de Ventas</title>
    <link rel="stylesheet" href="view/css/stylesMenu.css">
    <link rel="stylesheet" href="view/css/styles.css">
    <title>Menú principal</title>
</head>

<body>
    <nav>
        <ul>
            <li><a href="index.php?action=comerciales">Comerciales</a></li>
            <li><a href="index.php?action=productos">Productos</a></li>
            <li><a href="index.php?action=ventas">Ventas</a></li>
            <li><a href="index.php?action=ventasComercial">Ventas de un comercial</a></li>
        </ul>
    </nav>

    <div id="content">
        <?php
        include __DIR__ . '/view/menu.php'; //incluir el menu
        ?>
    </div>

</body>

</html>