<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Comerciales</title>
    <link rel="stylesheet" href="view/css/styles.css">
</head>
<body>
    <h1>Lista de Comerciales</h1>
    <a href="index.php?action=crear_comercial">Crear Nuevo Comercial</a>
    <a href="index.php?action=actualizarComercial">Actualizar Comercial</a>
    <a href="index.php?action=eliminarComercial">Eliminar Comercial</a>
    <a href="index.php">Volver al inicio</a>
    <table>
        <thead>
            <tr>
                <th>Código</th>
                <th>Nombre</th>
                <th>Salario</th>
                <th>Hijos</th>
                <th>Fecha de Nacimiento</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($comerciales as $comercial): ?>
                <tr>
                    <td><?php echo $comercial->getCodigo(); ?></td>
                    <td><?php echo $comercial->getNombre(); ?></td>
                    <td><?php echo $comercial->getSalario(); ?></td>
                    <td><?php echo $comercial->getHijos(); ?></td>
                    <td><?php echo $comercial->getFechaNacimiento(); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
