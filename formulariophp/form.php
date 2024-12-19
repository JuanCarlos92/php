<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Nombre = $_POST['Nombre'];
    $Apellidos = $_POST['Apellidos'];

    // Crear línea con datos 
    $linea = "Nombre: " . $Nombre . " Apellidos: " . $Apellidos . "\n";

    echo $linea;
}

?>