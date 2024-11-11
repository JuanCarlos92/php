<?php
$pi = 3.14159;
function calcularAreaCirculo($radio){
    global $pi;
    $radioAlCuadrado = pow($radio,2);
    $area = $pi *$radioAlCuadrado;
    echo "El area del circulo con el radio ".$radio ." es de: ". $area; 
}
calcularAreaCirculo(30);
?> 