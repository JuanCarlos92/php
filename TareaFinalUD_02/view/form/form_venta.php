<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Nueva Venta</title>
    <link rel="stylesheet" href="view/css/styles.css">
    <link rel="stylesheet" href="view/css/stylesForm.css">
</head>

<body>
    <h1>Formulario para Crear Ventas</h1>
    <form action="index.php?action=crear_venta" method="POST">
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

        <button type="submit">Crear Venta</button>
    </form>
    <h2>Lista de Comerciales</h2>
    <table>
        <thead>
            <tr>
                <th>Código Comercial</th>
                <th>Nombre Comercial</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($comerciales)): ?>
                <?php foreach ($comerciales as $comercial): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($comercial->getCodigo()); ?></td>
                        <td><?php echo htmlspecialchars($comercial->getNombre()); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td>No hay comerciales disponibles.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <h2>Lista de Productos</h2>
    <table>
        <thead>
            <tr>
                <th>Referencia del producto</th>
                <th>Nombre Producto</th>
                <th>Descripcion Producto</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($productos)): ?>
                <?php foreach ($productos as $producto): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($producto->getReferencia()); ?></td>
                        <td><?php echo htmlspecialchars($producto->getNombre()); ?></td>
                        <td><?php echo htmlspecialchars($producto->getDescripcion()); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td>No hay productos disponibles.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <a href="index.php?action=ventas">Volver a todas las ventas</a>
</body>

</html>