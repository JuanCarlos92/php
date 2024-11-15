<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de inserción</title>
</head>
<body>
    <?php

        $familia = $_POST["familia"];

        $servidor = "127.0.0.1";
        $usuario = "dwes";
        $bd = "dwes";
        $password = "abc1234";

        $conexion = mysqli_connect($servidor,$usuario,$password,$bd) or die("Error de conexion");

        $consulta = "SELECT cod, PVP FROM producto WHERE producto.familia = '$familia'";

        $registros = mysqli_query($conexion, $consulta); //registros contiene un array con arrays(1 array por registro.)

        foreach($registros as $k => $v){
            print $v['cod']." --> ".$v['PVP']."<br>";
        }    

    ?>
</body>
</html>