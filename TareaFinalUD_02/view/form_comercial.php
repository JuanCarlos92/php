<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Comercial</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Formulario para Crear Comercial</h1>
    <form action="index.php?action=crear_comercial" method="POST">
        <label for="codigo">Código:</label>
        <input type="text" name="codigo" id="codigo" required>
        <br>

        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" required>
        <br>

        <label for="salario">Salario:</label>
        <input type="number" name="salario" id="salario" required>
        <br>

        <label for="hijos">Hijos:</label>
        <input type="number" name="hijos" id="hijos" required>
        <br>

        <label for="fNacimiento">Fecha de Nacimiento:</label>
        <input type="date" name="fNacimiento" id="fNacimiento" required>
        <br>

        <button type="submit">Crear Comercial</button>
    </form>
    <a href="index.php?action=comerciales">Volver a la lista de comerciales</a>
</body>
</html>
