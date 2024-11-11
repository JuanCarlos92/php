<?php
$iva = true;
$precio = 10;
precio_con_iva(); // Da error, pues aquí aún no está definida la función
if ($iva) {
    function precio_con_iva() {
        global $precio;
        $precio_iva = $precio * 1.18;
        print "El precio con IVA es " . $precio_iva;
    }
}

precio_con_iva(); // Aquí ya no da error
?>

