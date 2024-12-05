<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Nueva Venta</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Formulario para Crear Venta</h1>
    <form action="index.php?action=crear_venta" method="POST">
        <label for="codComercial">Código Comercial:</label>
        <input type="text" name="codComercial" id="codComercial" required>
        <br>

        <label for="refProducto">Referencia del Producto:</label>
        <input type="text" name="refProducto" id="refProducto" required>
        <br>

        <label for="cantidad">Cantidad:</label>
        <input type="number" name="cantidad" id="cantidad" required>
        <br>

        <label for="fecha">Fecha:</label>
        <input type="date" name="fecha" id="fecha" required>
        <br>

        <button type="submit">Crear Venta</button>
    </form>

    <a href="index.php?action=ventas">Volver a todas las ventas</a>
</body>
</html>
