<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conversion de temperatura</title>
</head>
<body>
<h1>Conversion de temperatura</h1>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <input type="number" name="temperatura" placeholder="Introduce el Número " required>
        <br>
        <input type="submit" name="Farenheit" value="Farenheit">
        <input type="submit" name="Celsius" value="Celsius">

    </form>
    
    <?php
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $temperatura = $_POST["temperatura"];

        $resultado;

        if (isset($_POST["Farenheit"])) {
            $resultado = ($temperatura * 9/5) + 32 . " °F";

        } elseif (isset($_POST["Celsius"])) {
            $resultado = ($temperatura - 32) * 5/9 . " °C";
        }

        echo $resultado;

    }
    ?>

</body>

</html>