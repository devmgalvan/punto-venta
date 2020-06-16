<?php

$mod = isset($_GET['mod']) ? str_replace('.', '', $_GET['mod']) : '';

if ($mod) {
    $dir = "pages/{$mod}.php";

    if ($dir) {
        include $dir;

    } else {
        echo ('La pagina seleccionada no existe');
    }

} else {
    echo 'Selecciona una opción del menú';
}

//$swphp_contenido = ob_get_clean();
