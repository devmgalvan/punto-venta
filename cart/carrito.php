
<?php

if (isset($_POST['submit'])) {

    for ($i = 0; $i <= count($_POST['cantidad_form_carrito']); $i++) {

        $id_prod = $_POST['valor_id'][$i];

        $id_user_actual = $_SESSION['dondequeda_id'];

        $cantidad_c_nueva = $_POST["cantidad_form_carrito"][$i];

        $id_usuario_valor = $_POST['valor_id_usuario'][$i];

        $pedido_a_modificar = $_POST['pedido_actual'];

        if ($cantidad_c_nueva == 0) {

            $sql_ss = "DELETE FROM carrito WHERE id_productos = '$id_prod' AND id_usuario = '$id_usuario_valor' AND id_pedido = '$pedido_a_modificar'";

        } else {

            $sql_ss = "UPDATE carrito SET cantidad_c = '$cantidad_c_nueva' WHERE id_productos = '$id_prod' AND id_usuario = '$id_usuario_valor' AND id_pedido = $pedido_a_modificar";
        }

        $query_sql_ss = mysql_query($sql_ss);
    }

    $id_pedido_comprobar_borrar = $_GET['mostrar_id'];

    $sql_consulta_comprobar_borrar       = "SELECT * FROM carrito WHERE id_pedido = $id_pedido_comprobar_borrar";
    $query_sql_consulta_comprobar_borrar = mysql_query($sql_consulta_comprobar_borrar);

    if (mysql_num_rows($query_sql_consulta_comprobar_borrar) == 0) {

        $sql_borrar_pedido       = "DELETE FROM pedidos_carrito WHERE id_pedido_c = $id_pedido_comprobar_borrar";
        $query_sql_borrar_pedido = mysql_query($sql_borrar_pedido);
    }
}
?>

<h1>Ver carrito</h1>
<a href="index.php?page=productos_cart">Volver a la pagina de productos</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="index.php?page=pedidos">Volver a pedidos</a>
<form method="post" action="">
    <br />

    <table>
        <tr>
            <th>Nombre</th>
            <th>Cantidad</th>
            <th>Precio</th>
            <th>Total</th>
            <th>Usuario</th>
        </tr>

        <?php

$usuario_actual       = $_SESSION['dondequeda_id'];
$id_pedido_actual_url = $_GET['mostrar_id'];
$sql_1                = "SELECT * FROM carrito c, productos p, administrador a WHERE c.id_productos = p.id_productos AND c.id_usuario = a.id AND c.id_pedido = $id_pedido_actual_url";

$query      = mysql_query($sql_1);
$totalprice = 0;
while ($row = mysql_fetch_array($query)) {

    $subtotal = $row['cantidad_c'] * $row['precio'];
    $totalprice += $subtotal;

    /*Principio prueba*/

    $id_pedido_actual = $row['id_pedido'];

    $sql_id_pedido_actual = "SELECT * FROM carrito c, pedidos_carrito p WHERE c.id_pedido = p.id_pedido_c AND p.id_pedido_c = $id_pedido_actual";

    $query_sql_id_pedido_actual = mysql_query($sql_id_pedido_actual);

    $row_sql_id_pedido_actual = mysql_fetch_array($query_sql_id_pedido_actual);

    $estado_pedido_actual = $row_sql_id_pedido_actual['estado_pedido'];

    /*Fin prueba*/

    if (strcmp($estado_pedido_actual, "Pendiente") == 0) {
        ?>
                        <tr>
                            <td><input type="text" name="valor_id[]" value=<?php echo $row['id_productos']; ?> style="display: none;"><?php echo $row['modelo']; ?></td>
                            <td><input type="text" name="cantidad_form_carrito[]" size="5" value="<?php echo $row['cantidad_c']; ?>" /></td>
                            <td><input type="text" name="valor_id_usuario[]" value=<?php echo $row['id_usuario']; ?> style="display: none;"><?php echo $row['precio']; ?>€</td>
                            <td><input type="text" name="pedido_actual" value=<?php echo $id_pedido_actual_url; ?> style="display: none;"><?php echo $row['cantidad_c'] * $row['precio']; ?>€</td>
                            <td><?php echo $row['nombre']; ?><i class="caret"></i></td>
                        </tr>
                    <?php
} else {
        ?>
                        <tr>
                            <td><input type="text" name="valor_id[]" value=<?php echo $row['id_productos']; ?> style="display: none;"><?php echo $row['modelo']; ?></td>
                            <td><input type="text" name="cantidad_form_carrito[]" size="5" value="<?php echo $row['cantidad_c']; ?>" disabled/></td>
                            <td><input type="text" name="valor_id_usuario[]" value=<?php echo $row['id_usuario']; ?> style="display: none;"><?php echo $row['precio']; ?>€</td>
                            <td><input type="text" name="pedido_actual" value=<?php echo $id_pedido_actual_url; ?> style="display: none;"><?php echo $row['cantidad_c'] * $row['precio']; ?>€</td>
                            <td><?php echo $row['nombre']; ?><i class="caret"></i></td>
                        </tr>
                    <?php
}
}
?>
                    <tr>
                        <td colspan="5">Precio total: <?php echo $totalprice; ?>€</td>
                    </tr>
    </table>
    <br />
    <button type="submit" name="submit">Actualizar carrito</button>
</form>
<br />
<p>Para eliminar un artículo, establezca la cantidad en 0 y pulse actualizar.</p>