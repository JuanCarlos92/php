<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ventas por Comercial</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Ventas del Comercial</h1>

    <?php if (empty($ventas)): ?>
        <p>No se encontraron ventas para este comercial.</p>
    <?php else: ?>
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
    <?php endif; ?>

    <a href="index.php?action=ventas">Volver a todas las ventas</a>
</body>
</html>
