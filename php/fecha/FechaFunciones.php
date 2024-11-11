<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>fecha</title>
</head>
<body>
    <h1>Fecha actual</h1>

    <?php
    date_default_timezone_set('Europe/Madrid');

    
    function obtenerFecha($formato = 'l, d F Y') {
        return date($formato); 
    }
    
    echo obtenerFecha();
    ?>
</body>
</html>