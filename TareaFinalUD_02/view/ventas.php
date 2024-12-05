<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ventas</title>
    <link rel="stylesheet" href="view/css/styles.css">
</head>
<body>
    <h1>Lista de Ventas</h1>
    <table>
        <thead>
            <tr>
                <th>Código Comercial</th>
                <th>Referencia Producto</th>
                <th>Cantidad</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($ventas as $venta): ?>
                <tr>
                    <td><?php echo $venta->getCodComercial(); ?></td>
                    <td><?php echo $venta->getRefProducto(); ?></td>
                    <td><?php echo $venta->getCantidad(); ?></td>
                    <td><?php echo $venta->getFecha(); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <a href="index.php?action=crear_venta">Crear Nueva Venta</a>
    <a href="index.php">Volver al inicio</a>
</body>
</html>

