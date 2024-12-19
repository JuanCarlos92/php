<?php
//Obtener la ruta del archivo
$path = "../bd/persistencia.txt";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    //Obtener datos
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellido'];
    $email = $_POST['email'];

    //Crear línea con datos 
    $linea = "Nombre: " . $nombre . " Apellidos: " . $apellidos . " Email: " . $email ."\n";

    //Guardar los datos en el archivo
    $archivo = fopen($path, "a"); 

    fwrite($archivo, $linea);
    fclose($archivo);

//Leer y devolver el contenido del archivo
} elseif ($_SERVER["REQUEST_METHOD"] == "GET") { // (chatgpt)
    
    //Obtener el archivo
    if (file_exists($path)) {
        echo file_get_contents($path); //no aplica salto de linea (chatgpt)
    } else {
        echo "El archivo no existe.";
    }
}
?>