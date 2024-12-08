<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Venta</title>
    <link rel="stylesheet" href="view/css/styles.css">
    <link rel="stylesheet" href="view/css/stylesForm.css">
</head>

<body>
    <h1>Formulario para eliminar una venta</h1>
    <form action="index.php?action=eliminarVenta" method="POST">
        <label for="codComercial">Código Comercial:</label>
        <input type="text" name="codComercial" id="codComercial" required>
        <br>

        <label for="refProducto">Referencia del Producto:</label>
        <input type="text" name="refProducto" id="refProducto" required>
        <br>

        <label for="cantidad">Cantidad:</label>
        <input type="number" name="cantidad" id="cantidad" step="1" min="0" required>
        <br>

        <label for="fecha">Fecha:</label>
        <input type="date" name="fecha" id="fecha" required>
        <br>

        <button type="submit">Eliminar Venta</button>
    </form>
    <h2>Lista de ventas</h2>
    <table>
        <thead>
            <tr>
                <th>Cod Comercial</th>
                <th>Nombre Comercial</th>
                <th>Ref Producto</th>
                <th>Nombre Producto</th>
                <th>Descripcion Producto</th>
                <th>Cantidad</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($ventas as $venta): ?>
                <tr>
                    <td style="font-family: 'Courier New', Courier, monospace; font-weight: bold; color: #007bff;">
                        <?php echo $venta->getCodComercial(); ?>
                    </td>
                    <td><?php echo $venta->getNombreComercial(); ?></td>
                    <td style="font-family: 'Courier New', Courier, monospace; font-weight: bold; color: #007bff;">
                        <?php echo $venta->getRefProducto(); ?>
                    </td>
                    <td><?php echo $venta->getNombreProducto(); ?></td>
                    <td><?php echo $venta->getDescripcionProducto(); ?></td>
                    <td style="font-family: 'Courier New', Courier, monospace; font-weight: bold; color: #007bff;">
                        <?php echo $venta->getCantidad(); ?>
                    </td>
                    <td style="font-family: 'Courier New', Courier, monospace; font-weight: bold; color: #007bff;">
                        <?php echo $venta->getFecha(); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <a href="index.php?action=ventas">Volver a todas las ventas</a>
</body>

</html>