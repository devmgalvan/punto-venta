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
                        <div class="col-md-6">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Seleccione el nombre del proveedor</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>CIF</th>
                                                <th>Nombre</th>
                                                <th>Dirección</th>
                                                <th>Población</th>
                                                <th>Teléfono</th>
                                                <th>Opciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
if ($tipo2 == 1 || $tipo2 == 2) {

        $consulta = "SELECT id_proveedores,nombre,cif ,poblacion, correo, telefono, direccion FROM proveedores ORDER BY id_proveedores ASC ";
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
                                                              $fila[cif]
                                                        </td>
                                                         <td>
                                                            $fila[nombre]
                                                        </td>
                                                        <td> $fila[poblacion]                                                        </td>
                                                        <td>
                                                            $fila[direccion]
                                                        </td>
                                                         <td>
                                                            $fila[telefono]
                                                        </td>
                                                         ";

            echo "
                                                         <td><center>
                                                            ";

            if ($tipo2 == 1 || $tipo2 == 2) {

                echo "
       <a  href=?mod=registrotaller&cargo&codigo=" . $fila["id_proveedores"] . "><img src='./img/reparar.png' width='25' alt='Edicion' title='Registrar devolución a " . $fila["nombre"] . "'></a> ";

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
                                                <th>CIF</th>
                                                <th>Nombre</th>
                                                <th>Dirección</th>
                                                <th>Población</th>
                                                <th>Teléfono</th>
                                                <th>Opciones</th>
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

                            <form  name='fe' action='?mod=registro&nuevo' method='post' id='ContactForm'>
 <input title='Agregar nuevo proveedor' name='btn1'  class='btn btn-primary' type='submit' value='Agregar nuevo'>
  </form>

                            </div>  "; ?>
                        </br>
  <?php
echo "

  <div class='col-xs-6' id='imprimir'>
  <div class='dataTables_paginate paging_bootstrap'>
                                 <a target='_blank'  href=./pdf/listataller.php><img src='./img/impresora.png'  width='50' alt='Edicion' title='Imprimir productos del taller'>
                                 </a>
                                </div>
                                </div>

                                "; ?>

<?php
}

if (isset($_GET['listataller'])) {

    $x1 = $_GET['codigo'];

    if (isset($_POST['listataller'])) {

    }
    ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Lista de productos a devolver</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Modelo</th>
                                                <th>Incidencia</th>
                                                <th>Proveedor</th>
                                                <th>CIF</th>
                                                <th>Marca</th>
                                                <th>N° de serie</th>
                                                <th>Cantidad</th>
                                                <th>Opciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
if ($tipo2 == 1 || $tipo2 == 2) {

        $consulta = "SELECT * FROM taller INNER JOIN proveedores ON taller.cliente = proveedores.id_proveedores";

        /*$consulta="SELECT id_proveedores,nombre,cif ,poblacion, correo, telefono, direccion FROM proveedores ORDER BY id_proveedores ASC ";*/
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
                                                            $fila[falla]
                                                        </td>
                                                        <td> $fila[nombre]                                                        </td>
                                                         <td> $fila[cif]                                                        </td>
                                                        <td>
                                                            $fila[marca]
                                                        </td>
                                                         <td>
                                                            $fila[n_serie]
                                                        </td>
                                                        <td>
                                                            $fila[cantidad]
                                                        </td>
                                                         ";

            echo "
                                                         <td><center>
                                                            ";

            if ($tipo2 == 1 || $tipo2 == 2) {

                echo "
       <a  href=?mod=registrotaller&descargo&codigo=" . $fila["id_taller"] . "><img src='./img/cargo.png' width='25' alt='Edicion' title='Devolver " . $fila["descripcion_p"] . "'></a> ";

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
                                                <th>Modelo</th>
                                                <th>Incidencia</th>
                                                <th>Proveedor</th>
                                                <th>CIF</th>
                                                <th>Marca</th>
                                                <th>N° de serie</th>
                                                <th>Cantidad</th>
                                                <th>Opciones</th>
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

                            <form  name='fe' action='?mod=registro&nuevo' method='post' id='ContactForm'>
 <input title='Agregar nuevo proveedor' name='btn1'  class='btn btn-primary' type='submit' value='Agregar nuevo'>
  </form>

                            </div>  "; ?>
                        </br>

                            <?php

    echo "

  <div class='col-xs-6' id='imprimir'>
  <div class='dataTables_paginate paging_bootstrap'>
                                 <a target='_blank' href=./pdf/listataller.php><img src='./img/impresora.png'  width='50' alt='Edicion' title='Imprimir prductos del taller'>
                                 </a>
                                </div>
                                </div>
                                "; ?>

<?php
}

//eliminar

if (isset($_GET['cargo'])) {

//codigo que viene de la lista
    $x1 = $_GET['codigo'];

    if (isset($_POST['cargo'])) {

        $cantidad = strtoupper($_POST["cantidad"]);
        $marca    = $_POST["marca"];
        $numero   = $_POST["numero"];
        $tipo     = $_POST["tipo"];
        $modelo   = $_POST["modelo"];
        $falla    = $_POST["falla"];

        if ($x1 == "" & $can == "") {

            echo "
   <script> alert('error')</script>
   ";
            echo "<br>";

        } else {

/*$sql1="SELECT cantidad FROM `productos` WHERE id_productos='$x1'";
$bd->consulta($sql1);
 */

//isert de los datos a taller

            $sql = "INSERT INTO taller ( modelo, descripcion_p, fecha_entrada, cliente,marca,n_serie,falla,cantidad)
VALUES
( '$modelo', '$tipo', '$fecha2', '$x1','$marca','$numero','$falla','$cantidad')  ";
            $bd->consulta($sql);

//insert de los datos a movimientos

            $sql3 = "INSERT INTO movimientos ( cantidadm, fecha_movimiento, tipo_movimiento, admin,id_producto_m,motivo)VALUES
( '$cantidad', '$fecha2', 'ENTRADA', '$admin','$x1','reparacion')  ";

            $bd->consulta($sql3);

            //echo "Datos Guardados Correctamente";
            echo '<div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>¡El cargo se ha realizado correctamente!</b> ' . $modelo . '';

            echo '   </div>';

        }

    }

    $consulta = "SELECT nombre, poblacion, direccion,telefono,cif FROM proveedores where id_proveedores='$x1'";
    $bd->consulta($consulta);
    while ($fila = $bd->mostrar_registros()) {

        ?>

<center>
  <div class="col-md-4">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Datos del proveedor</h3>
                                </div>
                                    <div class="box-body">
                                        <div class="form-group">
                                            <center>
                                             <table id="example1" class="table table-bordered table-striped">
                                            <tr>
                                              <td>
                                                <h3>Nombre del proveedor</h3>
                                              </td>
                                            <td>
                                                <?php echo $fila[nombre]; ?>
                                            </td>
                                            </tr>
                                            <tr>
                                              <td>
                                                <h3>Población</h3>
                                              </td>
                                            <td>
                                                <?php echo $fila[poblacion]; ?>
                                            </td>
                                            </tr>
                                            <tr>
                                              <td>
                                                <h3>CIF</h3>
                                              </td>
                                            <td>
                                                <?php echo $fila[cif]; ?>
                                            </td>
                                            </tr>
                                            <tr>
                                              <td>
                                                <h3>Teléfono</h3>
                                              </td>
                                            <td>
                                                <?php echo $fila[telefono]; ?>
                                            </td>
                                            </tr>
                                            <tr>
                                              <td>
                                                <h3>Dirección</h3>
                                              </td>
                                            <td>
                                                <?php echo $fila[direccion]; ?>
                                           </td>
                                           </tr>
                                                </table>
  </center>
                                        </div>
                                    </div><!-- /.box-body -->
                            </div><!-- /.box -->
                            </center>

  <div class="col-md-8">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Datos del producto dañado</h3>
                                </div>

        <?php echo '  <form role="form"  name="fe" action="?mod=registrotaller&cargo=cargo&codigo=' . $x1 . '" method="post">';
        ?>
                                    <div class="box-body">
                                        <div class="form-group">

                                            <label for="exampleInputFile">Número de serie</label>
                                            <input  required type="text" name="numero" class="form-control" value="" id="exampleInputEmail1" placeholder="Número de serie">

                                            <label for="exampleInputFile">Tipo de producto</label>
                                            <input  required type="text" name="tipo" class="form-control" value="" id="exampleInputEmail1" placeholder="Tipo de producto">

                                            <label for="exampleInputFile">Marca</label>
                                            <input  required type="text" name="marca" class="form-control" value="" id="exampleInputEmail1" placeholder="Marca">

                                            <label for="exampleInputFile">Modelo</label>
                                            <input  required type="text" name="modelo" class="form-control" value="" id="exampleInputEmail1" placeholder="Modelo">

                                            <label for="exampleInputFile">Cantidad de productos</label>
                                            <input  required type="text" name="cantidad" class="form-control" value="" id="exampleInputEmail1" placeholder="Cantidad del producto">

                                            <label for="exampleInputFile">Descripción del problema</label>
                                            <div class="form-group">

                                            <textarea class="form-control" rows="3" name="falla" placeholder="Descripción del problema..."></textarea>
                                        </div>


</div>
</div>
</div>
<center>
<div class="box-footer">
                                        <input type=submit  class="btn btn-primary btn-lg" name="cargo" id="cargo" value="Cargar">

                                    </div>
                                  </center>
                                </form>
</div>
<div class="col-md-9">
</div>
                            <?php
echo '
  <div class="col-md-3">
  <div class="box">
                                <div class="box-header">
                                <div class="box-header">
                                    <h3> <center>Regresar a lista<a href="#" class="alert-link"></a></center></h3>
                                </div>
                        <center>
                            <form  name="fe" action="?mod=registrotaller&listataller" method="post" id="ContactForm">
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

//insert de los datos a movimientos

            $sql3 = "INSERT INTO movimientos ( cantidadm, fecha_movimiento, tipo_movimiento, admin,id_producto_m,motivo)VALUES
( '$cantidad', '$fecha2', 'SALIDA', '$admin','$x1','entrega')  ";

            $bd->consulta($sql3);

            $sql = "DELETE FROM taller WHERE id_taller='$x1' ";

            $bd->consulta($sql);

            //echo "Datos Guardados Correctamente";
            echo '<div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>¡El producto se ha devuelto correctamente!</b> ';

            echo '   </div>';

            echo '
                  <div class="col-md-3">
                  <div class="box">
                                                <div class="box-header">
                                                <div class="box-header">
                                                    <h3> <center>Regresar a lista<a href="#" class="alert-link"></a></center></h3>
                                                </div>
                                        <center>
                                            <form  name="fe" action="?mod=registrotaller&listataller" method="post" id="ContactForm">
                 <input title="Regresar a lista" name="btn1"  class="btn btn-primary"type="submit" value="Regresar a lista">
                  </form>
                  </center>
                                                </div>
                                            </div>
                                            </div>  ';

        }

    }

    $consulta = "SELECT * FROM taller INNER JOIN proveedores ON taller.cliente = proveedores.id_proveedores WHERE id_taller='$x1' ";
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
                                    <h3 class="box-title">Entregar productos</h3>
                                </div>

        <?php echo '  <form role="form"  name="fe" action="?mod=registrotaller&descargo=descargo&codigo=' . $x1 . '" method="post">';
        ?>
                                    <div class="box-body">
                                        <div class="form-group">

                                            <center>
  <label for="exampleInputFile">Datos del producto a devolver</label>

                                             <table id="example1" class="table table-bordered table-striped">
                                              <tr>
                                              <td>
                                                <h3>Nombre del proveedor</h3>
                                              </td>
                                            <td>
                                                <?php echo $fila[nombre]; ?>
                                            </td>
                                            </tr>
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
                                                <?php echo $fila[descripcion_p]; ?>
                                            </td>
                                            </tr>
                                            <tr>
                                              <td>
                                                <h3>Marca</h3>
                                              </td>
                                            <td>
                                                <?php echo $fila[marca]; ?>
                                            </td>
                                            </tr>
                                            <tr>
                                              <td>
                                                <h3>Número de serie</h3>
                                              </td>
                                            <td>
                                                <?php echo $fila[n_serie]; ?>
                                           </td>
                                           </tr>
                                           <tr>
                                              <td>
                                                <h3>Problema</h3>
                                              </td>
                                            <td>
                                                <?php echo $fila[falla]; ?>
                                           </td>
                                           </tr>
                                                </table>
  </center>
                                        </div>
                                    </div><!-- /.box-body -->
                                    <div class="box-footer">
                                        <input type=submit  class="btn btn-primary btn-lg" name="descargo" id="descargo" value="Devolver">
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
                            <form  name="fe" action="?mod=registrotaller&listataller" method="post" id="ContactForm">
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
</div>

<?php
include 'main_footer.php';
?>

