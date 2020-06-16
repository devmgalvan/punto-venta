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

if (isset($_GET['cargos'])) {

    $x1 = $_GET['codigo'];

    if (isset($_POST['cargos'])) {

    }
    ?>


                    <div class="row">
                        <div class="col-xs-9">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Seleccione el equipo que desea cargar o descargar</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Nombre</th>
                                                <th>Modelo</th>
                                                <th>Marca</th>
                                                <th>Precio</th>
                                                <th>Cantidad</th>
                                                <th>Opciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
if ($tipo2 == 1 || $tipo2 == 2) {

        $consulta = "SELECT id_productos,descripcion, modelo, marca, cantidad FROM productos ORDER BY id_productos ASC ";
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
                                                              $fila[modelo]
                                                        </td>
                                                         <td>
                                                            $fila[descripcion]
                                                        </td>
                                                        <td>
                                                            $fila[marca]
                                                        </td>
                                                         <td>";
            if ($fila[cantidad] == 0) {
                echo 0;
            } else {

                echo $fila[cantidad];

            }

            echo "

                                                        </td>

                                                         <td><center>
                                                            ";

            if ($tipo2 == 1 || $tipo2 == 2) {

                echo "
       <a  href=?mod=registromovimientos&cargo&codigo=" . $fila["id_productos"] . "><img src='./img/cargo.png' width='25' alt='Edicion' title='Cargar registros a " . $fila["descripcion"] . "'></a> ";
                echo "
       <a  href=?mod=registromovimientos&descargo&codigo=" . $fila["id_productos"] . "><img src='./img/descargo.png' width='25' alt='Edicion' title='Descargar registros a " . $fila["descripcion"] . "'></a> ";

            } else {

                echo "No disponible para invitado ";
            }

        }
        echo "    </center>     </td>
                                                    </tr>";

    }?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Nombre</th>
                                                <th>Modelo</th>
                                                <th>Marca</th>
                                                <th>Precio</th>
                                                <th>Cantidad</th>
                                                <th>Opciones</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>




                            <?php

    echo '
  <div class="col-md-3">
  <div class="box">
                                <div class="box-header">
                                <div class="box-header">
                                    <h3> <center>Registrar productos o accesorios <a href="#" class="alert-link"></a></center></h3>
                                </div>
                        <center>
                            <form  name="fe" action="?mod=registroproductos&nuevo" method="post" id="ContactForm">
 <input title="Agregar nuevo producto" name="btn1"  class="btn btn-primary"type="submit" value="Agregar nuevo">
  </form>
  </center>
                                </div>
                            </div>
                            </div>  '; ?>
                        </br>
  <div class="col-md-3">

                                </div>
<?php
}

//eliminar

if (isset($_GET['cargo'])) {

//codigo que viene de la lista
    $x1 = $_GET['codigo'];

    if (isset($_POST['cargo'])) {

        $cantidad = strtoupper($_POST["cantidad"]);

        if ($x1 == "" & $can == "") {

            echo "
   <script> alert('error')</script>
   ";
            echo "<br>";

        } else {

            $sql1 = "SELECT cantidad FROM `productos` WHERE id_productos='$x1'";
            $bd->consulta($sql1);

            $sql = "UPDATE  productos SET cantidad= cantidad+'$cantidad' WHERE id_productos='$x1' ";

            $bd->consulta($sql);

            $sql3 = "INSERT INTO movimientos ( cantidadm, fecha_movimiento, tipo_movimiento, admin,id_producto_m,motivo)VALUES
( '$cantidad', '$fecha2', 'ENTRADA', '$admin','$x1','compra')  ";

            $bd->consulta($sql3);

            //echo "Datos Guardados Correctamente";
            echo '<div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>¡El cargo se ha relizado correctamente!</b> ';

            echo '   </div>';

        }

    }

    $consulta = "SELECT modelo, descripcion, marca,precio,id_proveedor,cantidad FROM productos where id_productos='$x1'";
    $bd->consulta($consulta);
    while ($fila = $bd->mostrar_registros()) {

        ?>
<div class="col-md-3">
</div>
<center>
  <div class="col-md-5">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Cargar productos</h3>
                                </div>

        <?php echo '  <form role="form"  name="fe" action="?mod=registromovimientos&cargo=cargo&codigo=' . $x1 . '" method="post">';
        ?>
                                    <div class="box-body">
                                        <div class="form-group">


                                            <center>
  <label for="exampleInputFile">Cantidad que vas a cargar</label>
                                            <input onkeydown="return enteros(this, event)" required type="text" name="cantidad" class="form-control" value="" id="exampleInputEmail1" placeholder="00000">


                                             <table id="example1" class="table table-bordered table-striped">
                                              <tr>
                                              <td>
                                                <h3>Cantidad actual</h3>
                                              </td>
                                            <td>
                                           <?php
if ($fila[cantidad] == "") {
            echo "0";

        } else {
            echo $fila[cantidad];
        }
        ?>
                                            <tr>
                                              <td>
                                                <h3>Modelo</h3>
                                              </td>
                                            <td>
                                                <?php echo $fila[modelo]; ?>
                                           </td>
                                           </tr>
                                            <tr>
                                              <td>
                                                <h3>Descripción</h3>
                                              </td>
                                            <td>
                                                <?php echo $fila[descripcion]; ?>
                                            </td>
                                            </tr>
                                            <tr>
                                              <td>
                                                <h3>Marca</h3></td>
                                            <td>
                                                <?php echo $fila[marca]; ?>
                                           </td>
                                            </tr>
                                            <tr>
                                              <td>
                                                <h3>Precio</h3>
                                              </td>
                                            <td>
                                                <?php echo $fila[precio]; ?>
                                            </td>
                                            </tr>
                                           <tr>
                                              <td>
                                                <h3>Proveedor</h3>
                                              </td>
                                            <td>
                                                <?php echo $fila[id_proveedor]; ?>
                                            </td>
                                            </tr>
                                                </table>

  </center>
                                        </div>
                                    </div><!-- /.box-body -->
                                    <div class="box-footer">
                                        <input type=submit  class="btn btn-primary btn-lg" name="cargo" id="cargo" value="Cargar">
                                    </div>
                                </form>
                            </div><!-- /.box -->
                            </center>
                            <?php

        echo '
  <div class="col-md-3">
  <div class="box">
                                <div class="box-header">
                                <div class="box-header">
                                    <h3> <center>Regresar a lista<a href="#" class="alert-link"></a></center></h3>
                                </div>
                        <center>
                            <form  name="fe" action="?mod=registroproductos&lista" method="post" id="ContactForm">
 <input title="Regresar a lista" name="btn1"  class="btn btn-primary"type="submit" value="Regresar a lista">
  </form>
  </center>
                                </div>
                            </div>
                            </div>  ';

    }
}

if (isset($_GET['descargo'])) {

//codigo que viene de la lista
    $x1 = $_GET['codigo'];

    if (isset($_POST['descargo'])) {

        $cantidad = strtoupper($_POST["cantidad"]);

        if ($x1 == "") {

            echo "
   <script> alert('error')</script>
   ";
            echo "<br>";

        } else {

            $sql1 = "SELECT cantidad FROM `productos` WHERE id_productos='$x1'";
            $bd->consulta($sql1);

            $sql = "UPDATE  productos SET cantidad= cantidad-'$cantidad' WHERE id_productos='$x1' ";

            $bd->consulta($sql);

            $sql3 = "INSERT INTO movimientos ( cantidadm, fecha_movimiento, tipo_movimiento, admin,id_producto_m,motivo)VALUES
( '$cantidad', '$fecha2', 'SALIDAD', '$admin','$x1','venta')  ";

            $bd->consulta($sql3);

            //echo "Datos Guardados Correctamente";
            echo '<div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>¡El cargo se ha realizado correctamente!</b> ';

            echo '   </div>';

        }

    }

    $consulta = "SELECT modelo, descripcion, marca,precio,id_proveedor,cantidad FROM productos where id_productos='$x1'";
    $bd->consulta($consulta);
    while ($fila = $bd->mostrar_registros()) {

        ?>
<div class="col-md-3">
</div>
<center>
  <div class="col-md-5">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Descargar productos</h3>
                                </div>

        <?php echo '  <form role="form"  name="fe" action="?mod=registromovimientos&descargo=descargo&codigo=' . $x1 . '" method="post">';
        ?>
                                    <div class="box-body">
                                        <div class="form-group">
                                            <center>
  <label for="exampleInputFile">Cantidad que vas a descargar</label>
                                            <input onkeydown="return enteros(this, event)" required type="text" name="cantidad" class="form-control" value="" id="exampleInputEmail1" placeholder="00000">

                                             <table id="example1" class="table table-bordered table-striped">
                                             <tr>
                                              <td>
                                                <h3>Cantidad actual</h3>
                                              </td>
                                            <td>
                                           <?php
if ($fila[cantidad] == "") {
            echo "0";

        } else {
            echo $fila[cantidad];
        }
        ?>

                                            <tr>
                                              <td>
                                                <h3>Modelo</h3>
                                              </td>
                                            <td>
                                                <?php echo $fila[modelo]; ?>
                                           </td>
                                           </tr>
                                            <tr>
                                              <td>
                                                <h3>Descripción</h3>
                                              </td>
                                            <td>
                                                <?php echo $fila[descripcion]; ?>
                                            </td>
                                            </tr>
                                            <tr>
                                              <td>
                                                <h3>Marca</h3></td>
                                            <td>
                                                <?php echo $fila[marca]; ?>
                                           </td>
                                            </tr>
                                            <tr>
                                              <td>
                                                <h3>Precio</h3>
                                              </td>
                                            <td>
                                                <?php echo $fila[precio]; ?>
                                            </td>
                                            </tr>
                                           <tr>
                                              <td>
                                                <h3>Proveedor</h3>
                                              </td>
                                            <td>
                                                <?php echo $fila[id_proveedor]; ?>
                                            </td>
                                            </tr>
                                                </table>

  </center>
                                        </div>
                                    </div><!-- /.box-body -->
                                    <div class="box-footer">
                                        <input type=submit  class="btn btn-primary btn-lg" name="descargo" id="descargo" value="Descargar">
                                    </div>
                                </form>
                            </div><!-- /.box -->
                            </center>

                            <?php

        echo '
  <div class="col-md-3">
  <div class="box">
                                <div class="box-header">
                                <div class="box-header">
                                    <h3> <center>Regresar a lista<a href="#" class="alert-link"></a></center></h3>
                                </div>
                        <center>
                            <form  name="fe" action="?mod=registroproductos&lista" method="post" id="ContactForm">
 <input title="Regresar a lista" name="btn1"  class="btn btn-primary"type="submit" value="Regresar a lista">
  </form>
  </center>
                                </div>
                            </div>
                            </div>  ';

    }
}
?>
</div>

<?php
include 'main_footer.php';
?>

