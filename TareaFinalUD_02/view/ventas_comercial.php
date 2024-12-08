<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ventas por comercial</title>
    <link rel="stylesheet" href="view/css/styles.css">
</head>

<body>

    <?php if (empty($ventas)): ?>
        <p>No se encontraron ventas para este comercial.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>Código Comercial</th>
                    <th>Nombre Comercial</th>
                    <th>Referencia Producto</th>
                    <th>Nombre Producto</th>
                    <th>Cantidad</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($ventas as $venta): ?>
                    <tr>
                        <td><?php echo $venta->getCodComercial(); ?></td>
                        <td><?php echo $venta->getNombreComercial(); ?></td>
                        <td><?php echo $venta->getRefProducto(); ?></td>
                        <td><?php echo $venta->getNombreProducto(); ?></td>
                        <td><?php echo $venta->getCantidad(); ?></td>
                        <td><?php echo $venta->getFecha(); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</body>

</html>