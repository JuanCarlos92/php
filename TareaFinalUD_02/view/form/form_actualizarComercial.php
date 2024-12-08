<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Comercial</title>
    <link rel="stylesheet" href="view/css/styles.css">
    <link rel="stylesheet" href="view/css/stylesForm.css">
</head>

<body>
    <h1>Formulario para Actualizar un Comercial</h1>
    <form action="index.php?action=actualizarComercial" method="POST">
        <label for="codigo">Código:</label>
        <input type="number" name="codigo" id="codigo" step="1" min="0" required>
        <br>

        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre">
        <br>

        <label for="salario">Salario:</label>
        <input type="number" name="salario" id="salario" step="0.01" min="0">
        <br>

        <label for="hijos">Hijos:</label>
        <input type="number" name="hijos" id="hijos" step="1" min="0">
        <br>

        <label for="fNacimiento">Fecha de Nacimiento:</label>
        <input type="date" name="fNacimiento" id="fNacimiento">
        <br>

        <button type="submit">Actualizar Comercial</button>
    </form>

    <h2>Lista de Comerciales</h2>
    <table>
        <thead>
            <tr>
                <th>Codigo</th>
                <th>Nombre Comercial</th>
                <th>Salario</th>
                <th>Hijos</th>
                <th>Fecha de Nacimiento</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($comerciales)): ?>
                <?php foreach ($comerciales as $comercial): ?>
                    <tr>

                        <td><?php echo htmlspecialchars($comercial->getCodigo()); ?></td>
                        <td><?php echo htmlspecialchars($comercial->getNombre()); ?></td>
                        <td><?php echo htmlspecialchars($comercial->getSalario()); ?></td>
                        <td><?php echo htmlspecialchars($comercial->getHijos()); ?></td>
                        <td><?php echo htmlspecialchars($comercial->getFechaNacimiento()); ?></td>

                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td>No hay comerciales disponibles.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <a href="index.php?action=comerciales">Volver a la lista de comerciales</a>
</body>

</html>