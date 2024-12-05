<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Producto</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Crear Nuevo Producto</h1>
    <form action="index.php?action=crear_producto" method="POST">
        <label for="referencia">Referencia:</label>
        <input type="text" id="referencia" name="referencia" required>
        <br>

        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>
        <br>

        <label for="descripcion">Descripción:</label>
        <textarea id="descripcion" name="descripcion" required></textarea>
        <br>

        <label for="precio">Precio:</label>
        <input type="number" id="precio" name="precio" step="0.01" required>
        <br>

        <label for="descuento">Descuento (%):</label>
        <input type="number" id="descuento" name="descuento" step="1" max="100" min="0">
        <br>

        <button type="submit">Crear Producto</button>
    </form>
    <a href="index.php?action=productos">Volver a la lista de productos</a>
</body>
</html>
