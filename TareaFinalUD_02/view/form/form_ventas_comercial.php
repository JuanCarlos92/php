<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="view/css/styles.css">
    <link rel="stylesheet" href="view/css/stylesForm.css">
    <title>Formulario ventas por comerciales</title>
</head>

<body>
    <h1>Consultar ventas de un comercial</h1>
    <form action="index.php?action=ventasComercial" method="POST">
        <label for="codComercial">Código Comercial:</label>
        <input type="text" name="codComercial" required>
        <button type="submit">Consultar ventas</button>
    </form>
    <a href="index.php">Volver al inicio</a>
    <h2>Comerciales disponibles</h2>
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
</body>

</html>