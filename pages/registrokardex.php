<!DOCTYPE html>
<html class="lockscreen">
    <head>
        <meta charset="UTF-8">
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    </head>
<?php

require 'validarnum.php';

$admin = $_SESSION['dondequeda_nombre'];

$fecha2 = date("Y-m-d  H:i:s");

if (isset($_GET['diario'])) {

    $x1 = $_GET['codigo'];

    if (isset($_POST['diario'])) {

    }
    ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Control diario</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Descripción</th>
                                                <th>Modelo</th>
                                                <th>Marca</th>
                                                <th>Tipo de movimiento</th>
                                                <th>Fecha</th>
                                                <th>Cantidad</th>
                                                <th>Encargado</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
if ($tipo2 == 1 || $tipo2 == 2) {

        $consulta = "SELECT * FROM movimientos INNER JOIN productos ON  movimientos.id_producto_m = productos.id_productos AND datediff(now(),fecha_movimiento)=0 ";

        $bd->consulta($consulta);
        while ($fila = $bd->mostrar_registros()) {
            switch ($fila['status']) {
                case 1:
                    $btn_st     = "danger";
                    $txtFuncion = "Desactivar";
                    break;

                case 0:
                    $btn_st     = "primary";
                    $txtFuncion = "Activar";
                    break;
            }
            //echo '<li data-icon="delete"><a href="?mod=lugares?edit='.$fila['id_tipo'].'"><img src="images/lugares/'.$fila['imagen'].'" height="350" >'.$fila['nombre'].'</a><a href="?mod=lugares?borrar='.$fila['id_tipo'].'" data-position-to="window" >Borrar</a></li>';
            echo "<tr>
                                                        <td>
                                                              $fila[descripcion]
                                                        </td>
                                                         <td>
                                                            $fila[modelo]
                                                        </td>
                                                        <td> $fila[marca]                                                        </td>
                                                        <td>
                                                            $fila[tipo_movimiento]
                                                        </td>
                                                         <td>
                                                            $fila[fecha_movimiento]
                                                        </td>
                                                          <td>
                                                            $fila[cantidadm]
                                                        </td>
                                                         <td>
                                                            $fila[admin]
                                                        </td>
                                                  </center>
                                                    </tr>";

        }

    }?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Nombre</th>
                                                <th>Modelo</th>
                                                <th>Marca</th>
                                                <th>Tipo de movimiento</th>
                                                <th>Fecha</th>
                                                <th>Cantidad</th>
                                                <th>Encargado</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                            <?php

    echo "
  <div class='col-xs-6'>
  <div class='dataTables_paginate paging_bootstrap'>
                                </div>

                            <form  name='fe' action='?mod=registroproductos&nuevo' method='post' id='ContactForm'>
 <input title='Agregar nuevo registro' name='btn1'  class='btn btn-primary' type='submit' value='Agregar nuevo'>
  </form>

                            </div>  "; ?>
<?php
}

//control semanal

if (isset($_GET['semanal'])) {

    $x1 = $_GET['codigo'];

    if (isset($_POST['semanal'])) {

    }
    ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Control semanal</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Descripción</th>
                                                <th>Modelo</th>
                                                <th>Marca</th>
                                                <th>Tipo de movimiento</th>
                                                <th>Fecha</th>
                                                <th>Cantidad</th>
                                                <th>Encargado</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
if ($tipo2 == 1 || $tipo2 == 2) {

        $consulta = "SELECT * FROM movimientos INNER JOIN productos ON  movimientos.id_producto_m = productos.id_productos AND fecha_movimiento > DATE_SUB(CURDATE(), INTERVAL 7 DAY) ORDER BY fecha_movimiento DESC";

        $bd->consulta($consulta);
        while ($fila = $bd->mostrar_registros()) {
            switch ($fila['status']) {
                case 1:
                    $btn_st     = "danger";
                    $txtFuncion = "Desactivar";
                    break;

                case 0:
                    $btn_st     = "primary";
                    $txtFuncion = "Activar";
                    break;
            }
            //echo '<li data-icon="delete"><a href="?mod=lugares?edit='.$fila['id_tipo'].'"><img src="images/lugares/'.$fila['imagen'].'" height="350" >'.$fila['nombre'].'</a><a href="?mod=lugares?borrar='.$fila['id_tipo'].'" data-position-to="window" >Borrar</a></li>';
            echo "<tr>
                                                        <td>
                                                              $fila[descripcion]
                                                        </td>
                                                         <td>
                                                            $fila[modelo]
                                                        </td>
                                                        <td> $fila[marca]                                                        </td>
                                                        <td>
                                                            $fila[tipo_movimiento]
                                                        </td>
                                                         <td>
                                                            $fila[fecha_movimiento]
                                                        </td>
                                                          <td>
                                                            $fila[cantidadm]
                                                        </td>
                                                         <td>
                                                            $fila[admin]
                                                        </td>
                                                  </center>
                                                    </tr>";

        }

    }?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Nombre</th>
                                                <th>Modelo</th>
                                                <th>Marca</th>
                                                <th>Tipo de movimiento</th>
                                                <th>Fecha</th>
                                                <th>Cantidad</th>
                                                <th>Encargado</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                            <?php

    echo "
  <div class='col-xs-6'>
  <div class='dataTables_paginate paging_bootstrap'>
                                </div>

                            <form  name='fe' action='?mod=registroproductos&nuevo' method='post' id='ContactForm'>
 <input title='Agregar nuevo registro' name='btn1'  class='btn btn-primary' type='submit' value='Agregar nuevo'>
  </form>

                            </div>  "; ?>


<?php
}

//control semanal

if (isset($_GET['mensual'])) {

    $x1 = $_GET['codigo'];

    if (isset($_POST['mensual'])) {

    }
    ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Control mensual</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Descripción</th>
                                                <th>Modelo</th>
                                                <th>Marca</th>
                                                <th>Tipo de movimiento</th>
                                                <th>Fecha</th>
                                                <th>Cantidad</th>
                                                <th>Encargado</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
if ($tipo2 == 1 || $tipo2 == 2) {

        $consulta = "SELECT * FROM movimientos INNER JOIN productos ON  movimientos.id_producto_m = productos.id_productos AND fecha_movimiento > DATE_SUB( CURDATE( ) , INTERVAL DAYOFMONTH( CURDATE( ) )DAY ) ORDER BY fecha_movimiento DESC";

        $bd->consulta($consulta);
        while ($fila = $bd->mostrar_registros()) {
            switch ($fila['status']) {
                case 1:
                    $btn_st     = "danger";
                    $txtFuncion = "Desactivar";
                    break;

                case 0:
                    $btn_st     = "primary";
                    $txtFuncion = "Activar";
                    break;
            }
            //echo '<li data-icon="delete"><a href="?mod=lugares?edit='.$fila['id_tipo'].'"><img src="images/lugares/'.$fila['imagen'].'" height="350" >'.$fila['nombre'].'</a><a href="?mod=lugares?borrar='.$fila['id_tipo'].'" data-position-to="window" >Borrar</a></li>';
            echo "<tr>
                                                        <td>
                                                              $fila[descripcion]
                                                        </td>
                                                         <td>
                                                            $fila[modelo]
                                                        </td>
                                                        <td> $fila[marca]                                                        </td>
                                                        <td>
                                                            $fila[tipo_movimiento]
                                                        </td>
                                                         <td>
                                                            $fila[fecha_movimiento]
                                                        </td>
                                                          <td>
                                                            $fila[cantidadm]
                                                        </td>
                                                         <td>
                                                            $fila[admin]
                                                        </td>
                                                  </center>
                                                    </tr>";

        }

    }?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Nombre</th>
                                                <th>Modelo</th>
                                                <th>Marca</th>
                                                <th>Tipo de movimiento</th>
                                                <th>Fecha</th>
                                                <th>Cantidad</th>
                                                <th>Encargado</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                            <?php

    echo "
  <div class='col-xs-6'>
  <div class='dataTables_paginate paging_bootstrap'>
                                </div>
                            <form  name='fe' action='?mod=registroproductos&nuevo' method='post' id='ContactForm'>
 <input title='Agregar nuevo registro' name='btn1'  class='btn btn-primary' type='submit' value='Agregar nuevo'>
  </form>

                            </div>  "; ?>


<?php
}

if (isset($_GET['total'])) {

    $x1 = $_GET['codigo'];

    if (isset($_POST['total'])) {

    }
    ?>


                    <div class="row">
                        <div class="col-md-6">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Control completo</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Descripción</th>
                                                <th>Modelo</th>
                                                <th>Marca</th>
                                                <th>Tipo de movimiento</th>
                                                <th>Fecha</th>
                                                <th>Cantidad</th>
                                                <th>Encargado</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
if ($tipo2 == 1 || $tipo2 == 2) {

        $consulta = "SELECT * FROM movimientos INNER JOIN productos ON  movimientos.id_producto_m = productos.id_productos ";

        $bd->consulta($consulta);
        while ($fila = $bd->mostrar_registros()) {
            switch ($fila['status']) {
                case 1:
                    $btn_st     = "danger";
                    $txtFuncion = "Desactivar";
                    break;

                case 0:
                    $btn_st     = "primary";
                    $txtFuncion = "Activar";
                    break;
            }
            //echo '<li data-icon="delete"><a href="?mod=lugares?edit='.$fila['id_tipo'].'"><img src="images/lugares/'.$fila['imagen'].'" height="350" >'.$fila['nombre'].'</a><a href="?mod=lugares?borrar='.$fila['id_tipo'].'" data-position-to="window" >Borrar</a></li>';
            echo "<tr>
                                                        <td>
                                                              $fila[descripcion]
                                                        </td>
                                                         <td>
                                                            $fila[modelo]
                                                        </td>
                                                        <td> $fila[marca]                                                        </td>
                                                        <td>
                                                            $fila[tipo_movimiento]
                                                        </td>
                                                         <td>
                                                            $fila[fecha_movimiento]
                                                        </td>
                                                          <td>
                                                            $fila[cantidadm]
                                                        </td>
                                                         <td>
                                                            $fila[admin]
                                                        </td>
                                                  </center>
                                                    </tr>";
        }

    }?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Nombre</th>
                                                <th>Modelo</th>
                                                <th>Marca</th>
                                                <th>Tipo de movimiento</th>
                                                <th>Fecha</th>
                                                <th>Cantidad</th>
                                                <th>Encargado</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>




                            <?php

    echo "
  <div class='col-xs-6'>
  <div class='dataTables_paginate paging_bootstrap'>
                                </div>

                            <form  name='fe' action='?mod=registroproductos&nuevo' method='post' id='ContactForm'>
 <input title='Agregar nuevo registro' name='btn1'  class='btn btn-primary' type='submit' value='Agregar nuevo'>
  </form>

                            </div>  "; ?>

<?php
}

?>
</div>
</div>
<?php
include 'main_footer.php';
?>









