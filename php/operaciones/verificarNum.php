<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Par o Impar</title>
</head>
<body>
<h1>Par o Impar</h1>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <input type="number" name="numero" placeholder="Introduce el Número " required>
    <input type="submit" value="Comprobar">
    </form>
    
    <?php
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $num = $_POST["numero"];
        
        $resultado="";

        
        if($num % 2 == 0){
            $resultado = "El número es par";

        }else{
            $resultado = "El número es impar";
        }
                
        echo $resultado;
    }
    ?>

</body>

</html>