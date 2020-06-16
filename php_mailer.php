<!DOCTYPE html>
<html class="lockscreen">
    <head>
        <meta charset="UTF-8">
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    </head>
<?php

require 'validarnum.php';
$fecha2 = date("Y-m-d");

if (isset($_GET['mail'])) {

    if (isset($_POST['mail'])) {

        $destinatario = "miguelsanfer7@gmail.com";
        $asunto       = "Este mensaje es de prueba";
        $cuerpo       = '
<html>
<head>
   <title>Prueba de correo</title>
</head>
<body>
<h1>CPM WEB</h1>
<p>
<b>Esto es una prueba de la librería PHP MAIL para mandar correos desde la aplicación web.</b>
</p>
</body>
</html>
';

//para el envío en formato HTML
        $headers = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";

//dirección del remitente
        $headers .= "From: Miguel Angel Galvan Dongil <mgalvandongil@gmail.com>\r\n";

//dirección de respuesta, si queremos que sea distinta que la del remitente
        $headers .= "Reply-To: mgalvandongil@gmail.com\r\n";

//ruta del mensaje desde origen a destino
        $headers .= "Return-path: mgalvandongil@gmail.com\r\n";

//direcciones que recibirán copia
        $headers .= "Cc: mgalvandongil@gmail.com\r\n";

//direcciones que recibirán copia oculta
        $headers .= "Bcc: mgalvandongil@gmail.com\r\n";

        mail($destinatario, $asunto, $cuerpo, $headers)

        ;?>
    }
}

//////////////////////////