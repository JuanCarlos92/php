<!DOCTYPE html>
<html lang="en">
<head>
    <title>Calculadora</title>
</head>
<body>
    <h1>Calculadora</h1>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <input type="number" name="numero1" placeholder="Número 1" required>
        <select name ="operador">
            <option value="suma">+</option>
            <option value="resta">-</option>
            <option value="multiplicar">*</option>
            <option value="dividir">/</option>
        </select>
        <input type="number" name="numero2" placeholder="Número 2" required>
    <input type="submit" value="Calcular">
    </form>
    
    <?php
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $num1 = $_POST["numero1"];
            $num2 = $_POST["numero2"];
            $operador = $_POST["operador"];
        
        $resultado=0;

        if($operador == "suma"){
            $resultado =  $num1 + $num2;

        }
        elseif($operador == "resta"){
            $resultado = $num1 - $num2;
            
        }
        elseif($operador == "multiplicar"){
            $resultado = $num1 * $num2;
            
        }
        elseif($operador == "dividir"){
            $resultado = $num1 / $num2;
           
        }
        echo "Resultado: ".$resultado;

        }
    ?>
</body>
</html>