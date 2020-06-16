<?php
session_start();
require "includes/connect_carrito.php";
if (isset($_GET['page'])) {

    $pages = array("productos_cart", "carrito", "pedidos");

    if (in_array($_GET['page'], $pages)) {

        $_page = $_GET['page'];

    } else {

        $_page = "productos_cart";
    }

} else {

    $_page = "productos_cart";
}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="css/reset.css" />
    <link rel="stylesheet" href="css/carrito1.css" />

    <title>Compras CPM | Software</title>

</head>
<body>

    <div id="container">

        <div id="main">

            <?php include $_page . ".php";?>

        </div><!--end main-->

        <div id="sidebar">

            <h1>Carrito</h1>
<?php

$id_usuario_actual = $_SESSION['dondequeda_id'];

$sql_1 = "SELECT * FROM carrito c, productos p, administrador a, pedidos_carrito x WHERE c.id_productos = p.id_productos AND c.id_usuario = a.id AND c.id_usuario = '$id_usuario_actual' AND c.id_pedido = x.id_pedido_c AND x.estado_pedido = 'Pendiente'";

$query_sql_1 = mysql_query($sql_1);

if (mysql_num_rows($query_sql_1) != 0) {

    while ($row = mysql_fetch_array($query_sql_1)) {

        ?>

        <td><?php echo $row['modelo'] . " x " . $row['cantidad_c']; ?></td>
        <br>
        <br>


        <?php
}

} else {

    echo "<p>El carrito está vacío, debes agregar productos.</p>";
}

?>
        </div><!--end sidebar-->
    </div><!--end container-->
</body>
</html>