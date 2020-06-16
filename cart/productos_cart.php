<?php

if (isset($_GET['action']) == "add") {

    $fecha_actual = date('Y-m-d');
    $id_user      = $_SESSION['dondequeda_id'];
    $id           = intval($_GET['id']);

    $sql_consul_pedidos = "SELECT * FROM pedidos_carrito p, carrito c WHERE c.id_pedido = p.id_pedido_c AND p.estado_pedido = 'Pendiente' AND c.id_usuario = $id_user";

    $query_sql_consul_pedidos = mysql_query($sql_consul_pedidos);

    $row = mysql_fetch_array($query_sql_consul_pedidos);

    if (mysql_num_rows($query_sql_consul_pedidos) != 0) {

        $numero_pedido_actual = $row['id_pedido_c'];

        //Comprueba si el pedido actual (el primero, segundo) si hay alguna linea con el pedido actual y el usuario logueado

        $sql_consul_producto_pedido = "SELECT * FROM carrito WHERE id_pedido = $numero_pedido_actual AND id_usuario = $id_user AND id_productos = $id";

        $query_sql_consul_producto_pedido = mysql_query($sql_consul_producto_pedido);

        if (mysql_num_rows($query_sql_consul_producto_pedido) != 0) {

            //Comprueba si con el pedido actual el usuario logueado y el producto seleccionado hay algun registro o linea

            $sql_row_carrito = mysql_fetch_array($query_sql_consul_producto_pedido);

            $cantidad_mas_fila = $sql_row_carrito['cantidad_c'] + 1;

            $sql_update_cantidad_c = "UPDATE carrito SET cantidad_c = '$cantidad_mas_fila' WHERE id_productos = '$id' AND id_usuario ='$id_user' AND id_pedido = '$numero_pedido_actual'";

            $query_sql_update_cantidad = mysql_query($sql_update_cantidad_c);

        } else {

            $sql_insertar_nuevo_prod_carrito       = "INSERT INTO carrito VALUES ('$id', '$id_user', '1', '$numero_pedido_actual')";
            $query_sql_insertar_nuevo_prod_carrito = mysql_query($sql_insertar_nuevo_prod_carrito);
        }

    } else {

        $sql_consul_total_pedidos       = "SELECT * FROM pedidos_carrito";
        $query_sql_consul_total_pedidos = mysql_query($sql_consul_total_pedidos);

        if (mysql_num_rows($query_sql_consul_total_pedidos) != 0) {

            $sql_consulta_max_id_pedidos       = "SELECT MAX(id_pedido_c)maximo FROM pedidos_carrito";
            $query_sql_consulta_max_id_pedidos = mysql_query($sql_consulta_max_id_pedidos);

            $row = mysql_fetch_array($query_sql_consulta_max_id_pedidos);

            $id_nuevo_pedido = $row['maximo'] + 1;

            $sql_insertar_nuevo_pedido   = "INSERT INTO pedidos_carrito VALUES ('$id_nuevo_pedido', 'Pendiente', '$fecha_actual')";
            $query_insertar_nuevo_pedido = mysql_query($sql_insertar_nuevo_pedido);

            $sql_insertar_into_carrito       = "INSERT INTO carrito VALUES ('$id', '$id_user', '1', '$id_nuevo_pedido')";
            $query_sql_insertar_into_carrito = mysql_query($sql_insertar_into_carrito);

        } else {

            $sql_insertar_nuevo_pedido   = "INSERT INTO pedidos_carrito VALUES ('1000', 'Pendiente', '$fecha_actual')";
            $query_insertar_nuevo_pedido = mysql_query($sql_insertar_nuevo_pedido);

            $sql_insert_carrito_values       = "INSERT INTO carrito VALUES ('$id', '$id_user', '1', '1000')";
            $query_sql_insert_carrito_values = mysql_query($sql_insert_carrito_values);
        }
    }
}

?>
    <h1>Lista de productos</h1>
    <a href="http://192.168.1.243/puntoventa6/index.php?mod=index">Volver inicio</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<!--<a href="index.php?page=carrito">Ir al carrito</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--><a href="index.php?page=pedidos">Pedidos</a>
    <form method="post" action="http://192.168.1.243/puntoventa6/index.php?mod=index"></form>
    <br>

    <?php

if (isset($message)) {
    echo "<h2>$message</h2>";
}
?>
    <table>
        <tr>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Precio</th>
            <th>Acción</th>
        </tr>

        <?php

$sql_productos       = "SELECT * FROM productos ORDER BY id_productos ASC";
$query_sql_productos = mysql_query($sql_productos);

while ($row = mysql_fetch_array($query_sql_productos)) {
    ?>
            <tr>
                <td><?php echo $row['modelo']; ?></td>
                <td><?php echo $row['descripcion']; ?></td>
                <td><?php echo $row['precio']; ?>€</td>
                <td><a href="index.php?page=productos_cart&action=add&id=<?php echo $row['id_productos']; ?>">Añadir al carrito</a></td>
            </tr>
        <?php
}
?>
    </table>