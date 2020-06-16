<?php

$server = "localhost";
$user   = "root";
$pass   = "XXXXXXXXXXX";
$db     = "basecelulares";

// connect to mysql

mysql_connect($server, $user, $pass) or die("Lo siento, no ha sido posible conectar con la base de datos.");

// select the db

mysql_select_db($db) or die("Lo siento, no se ha seleccionado la base de datos.");
