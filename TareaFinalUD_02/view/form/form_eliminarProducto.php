<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Producto</title>
    <link rel="stylesheet" href="view/css/styles.css">
    <link rel="stylesheet" href="view/css/stylesForm.css">
</head>

<body>
    <h1>Formulario para Eliminar un Producto</h1>
    <form action="index.php?action=eliminarProducto" method="POST">
        <label for="referencia">Referencia:</label>
        <input type="text" id="referencia" name="referencia" required>
        <br>

        <button type="submit">Eliminar Producto</button>
    </form>

    <h2>Lista de Productos</h2>
    <table>
        <thead>
            <tr>
                <th>Referencia del producto</th>
                <th>Nombre Producto</th>
                <th>Descripcion Producto</th>
                <th>Precio Producto</th>
                <th>Descuento Producto</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($productos)): ?>
                <?php foreach ($productos as $producto): ?>
                    <tr>

                        <td><?php echo htmlspecialchars($producto->getReferencia()); ?></td>
                        <td><?php echo htmlspecialchars($producto->getNombre()); ?></td>
                        <td><?php echo htmlspecialchars($producto->getDescripcion()); ?></td>
                        <td><?php echo htmlspecialchars($producto->getPrecio()); ?></td>
                        <td><?php echo htmlspecialchars($producto->getDescuento()); ?></td>

                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td>No hay productos disponibles.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <a href="index.php?action=productos">Volver a la lista de productos</a>
</body>

</html>