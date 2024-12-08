<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Productos</title>
    <link rel="stylesheet" href="view/css/styles.css">
</head>

<body>
    <h1>Lista de Productos</h1>
    <a href="index.php?action=crear_producto">Agregar Nuevo Producto</a>
    <a href="index.php?action=actualizarProducto">Actualizar Producto</a>
    <a href="index.php?action=eliminarProducto">Eliminar Producto</a>
    <a href="index.php">Volver al inicio</a>
    <table>
        <thead>
            <tr>
                <th>Referencia</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Descuento</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($productos as $producto): ?>
                <tr>
                    <td><?= htmlspecialchars($producto->getReferencia()) ?></td>
                    <td><?= htmlspecialchars($producto->getNombre()) ?></td>
                    <td><?= htmlspecialchars($producto->getDescripcion()) ?></td>
                    <td><?= htmlspecialchars($producto->getPrecio()) ?></td>
                    <td><?= htmlspecialchars($producto->getDescuento()) ?>%</td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>

</html>