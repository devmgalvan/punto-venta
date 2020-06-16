
<?php

if (isset($_POST['guardar'])) {

    for ($i = 0; $i <= count($_POST['estado_pedido']); $i++) {

        $guardar_estado_pedido = $_POST['estado_pedido'][$i];
        $guardar_id_pedido     = $_POST['valor_id_pedido_actual'][$i];

        $sql_update_estado_pedido       = "UPDATE pedidos_carrito SET estado_pedido = '$guardar_estado_pedido' WHERE id_pedido_c = '$guardar_id_pedido'";
        $query_sql_update_estado_pedido = mysql_query($sql_update_estado_pedido);
    }
}
?>

<h1>Lista de pedidos</h1>
<a href="index.php?page=productos_cart">Volver a la pagina de productos</a>
<form method="post" action="index.php?page=pedidos">
    <br />
    <table>
        <tr>
            <th>Nº Pedido</th>
            <th>Usuario</th>
            <th>Fecha</th>
            <th>Estado del pedido</th>
        </tr>

        <?php

$sql_1 = "SELECT * FROM pedidos_carrito ORDER BY id_pedido_c ASC";

$query = mysql_query($sql_1);
while ($row = mysql_fetch_array($query)) {

    $id_pedido_actual = $row['id_pedido_c'];

    $sql_consulta_nombre_user_pedido   = "SELECT * FROM carrito WHERE id_pedido = $id_pedido_actual";
    $query_consulta_nombre_user_pedido = mysql_query($sql_consulta_nombre_user_pedido);

    $row_id_usuario_pedidos  = mysql_fetch_array($query_consulta_nombre_user_pedido);
    $id_variable_user_pedido = $row_id_usuario_pedidos['id_usuario'];

    $sql_consulta_admin_id_usuario   = "SELECT * FROM administrador WHERE id = $id_variable_user_pedido";
    $query_consulta_admin_id_usuario = mysql_query($sql_consulta_admin_id_usuario);

    $row_consulta_admin_id_usuario = mysql_fetch_array($query_consulta_admin_id_usuario);
    $row_nombre_usuario            = $row_consulta_admin_id_usuario['nombre'];

    ?>
                        <tr>
                            <td><a href="index.php?page=carrito&mostrar_id=<?php echo $id_pedido_actual; ?>"><?php echo $id_pedido_actual; ?></td>
                            <td><?php echo $row_nombre_usuario; ?><i class="caret"></i></td>
                            <td><?php echo $row['fecha_pedido']; ?></td>
                            <input type="text" name="valor_id_pedido_actual[]" value=<?php echo $id_pedido_actual; ?> style="display: none;">
                            <td>

                                <select name="estado_pedido[]">
                                    <?php

    if (strcmp($row['estado_pedido'], 'Tramitado') == 0) {

        ?>
                                    <option value="Tramitado" selected>Tramitado</option>
                                    <option value="Pendiente">Pendiente</option>
<?php

    } else {

        ?>
                                    <option value="Tramitado">Tramitado</option>
                                    <option value="Pendiente" selected>Pendiente</option>

                                    <?php
}
    ?>

                                </select>
                            </td>
                        </tr>
                    <?php
}
;?>
    </table>
    <br />
    <button type="submit" name="guardar">Guardar</button>
</form>
<br />