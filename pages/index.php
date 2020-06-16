<!DOCTYPE html>
<html class="lockscreen">
    <head>
        <meta charset="UTF-8">
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    </head>
<?php
;?>
  <h4 class="page-header">
                        <?php
$dias  = array("Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado");
$meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
$fecha = $dias[date('w')] . " " . date('d') . " de " . $meses[date('n') - 1] . " del " . date('Y');
?>
                        <small><?php echo $fecha; ?></small>
                        <br>
                        REGISTRO Y MANTENIMIENTO DE COMPRAS<small><code>Seleccione la opción que desea dependiendo de la categoría</code><code></code></small>
                   </h4>
                    <!-- Small boxes (Stat box) -->
                    <!-- Small boxes (Stat box) -->
                    <div class="row">

                    <?php
if ($tipo2 == 1 || $tipo2 == 2) {
    echo '
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-aqua">
                                <div class="inner">
                                    <h3>
                                         Proveedores
                                    </h3>
                                    <p>
                                        Registrar proveedores
                                    </p>
                                </div>

                                <div class="icon"><a href="?mod=registro&nuevo"  id="alimen" data-icon="custom" data-transition="slide" data-prefetch="true" data-id="alimen" class="small-box-footer">

                                </div>
                                    MÁS INFORMACIÓN <i class="glyphicon glyphicon-info-sign"></i>
                                </a>
                            </div>
                        </div>

                        <!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h3>Productos<sup style="font-size: 20px"></sup></h3>
                                    <p>Registrar productos o accesorios</p>
                                </div>
                                <div class="icon">
                                    <a href="?mod=registroproductos&nuevo" class="small-box-footer"></a>
                                </div>
                                <a href="?mod=registroproductos&nuevo" class="small-box-footer">
                                    MÁS INFORMACIÓN <i class="glyphicon glyphicon-info-sign"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-yellow">
                                <div class="inner">
                                    <h3>Inventario</h3>
                                    <p>Control completo</p>
                                </div>
                                <div class="icon">
                                    <a href="?mod=registrokardex&total" class="small-box-footer"></a>
                                </div>
                                <a href="?mod=registrokardex&total" class="small-box-footer">
                                    MÁS INFORMACIÓN <i class="glyphicon glyphicon-info-sign"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->


                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-blue">
                                <div class="inner">
                                    <h3>Usuarios</h3>
                                    <p>Lista de usuarios</p>
                                </div>
                                <div class="icon">
                                    <i class="ion "></i>
                                </div>
                                <a href="?mod=registroadmin&lista=lista" class="small-box-footer">
                                    MÁS INFORMACIÓN <i class="glyphicon glyphicon-info-sign"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                    </div><!-- /.row -->
                    ';
}

?>
                    <!-- top row -->
                    <!-- /.row -->
                    <!-- START ACCORDION & CAROUSEL-->

                      <div class="col-md-6">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Lista de productos y accesorios</h3>
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

    $consulta = "SELECT id_productos, descripcion, modelo, precio, marca, cantidad FROM productos ORDER BY id_productos ASC ";

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
                                                         <td>
                                                            $fila[precio]
                                                        </td>
                                                         <td>";
        if ($fila[cantidad] == 0) {
            echo 0;
        } else {

            echo $fila['cantidad'];

        }

        echo "

                                                        </td>

                                                         <td><center>
                                                            ";

        echo "
       <a  href=?mod=registroproductos&consultar&codigo=" . $fila["id_productos"] . "><img src='./img/consultarr.png' width='25' alt='Edicion' title='Ver los datos de " . $fila["descripcion"] . "'></a> ";
        if ($tipo2 == 1 || $tipo2 == 2) {
            echo "

      <a  href=?mod=registroproductos&editar&codigo=" . $fila["id_productos"] . "><img src='./img/editar.png' width='25' alt='Edicion' title='Editar los datos de " . $fila["descripcion"] . "'></a>
      <a   href=?mod=registroproductos&eliminar&codigo=" . $fila["id_productos"] . "><img src='./img/elimina2.png'  width='25' alt='Edicion' title='Eliminar a " . $fila["descripcion"] . "'></a>

       <a  href=?mod=registromovimientos&cargo&codigo=" . $fila["id_productos"] . "><img src='./img/cargo.png' width='25' alt='Edicion' title='Cargar cantidad a " . $fila["descripcion"] . "'></a> ";

            echo "
       <a  href=?mod=registromovimientos&descargo&codigo=" . $fila["id_productos"] . "><img src='./img/descargo.png' width='25' alt='Edicion' title='Descargar cantidad de " . $fila["descripcion"] . "'></a>
      ";
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
                        </div><!-- /.col -->
                        <!--<div class="col-md-6">
                            <div class="box box-solid">
                                <div class="box-header">

                                </div><!-- /.box-header -->
                                <!--<div class="box-body">
                                    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                                        <ol class="carousel-indicators">
                                            <li data-target="#carousel-example-generic" data-slide-to="0" class=""></li>
                                            <li data-target="#carousel-example-generic" data-slide-to="1" class="active"></li>
                                            <li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
                                        </ol>
                                        <!--<div class="carousel-inner">
                                            <div class="item">
                                                <img src="img/Anagramblanco_fondo.jpg" alt="First slide">
                                                <div class="carousel-caption">

                                                </div>
                                            </div>
                                            <div class="item active">
                                                <img src="img/Anagramblanco_fondo.jpg" alt="Second slide">
                                                <div class="carousel-caption">

                                                </div>
                                            </div>
                                            <div class="item">
                                                <img src="img/Anagramblanco_fondo.jpg" alt="Third slide">
                                                <div class="carousel-caption">

                                                </div>
                                            </div>
                                        </div>
                                        <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                                            <span class="glyphicon glyphicon-chevron-left"></span>
                                        </a>
                                        <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                                            <span class="glyphicon glyphicon-chevron-right"></span>
                                        </a>-->
                                    </div>
                                </div><!-- /.box-body
                            </div><!-- /.box -->
                        </div><!-- /.col -->

                    </div><!-- /.row -->
                    <!-- END ACCORDION & CAROUSEL-->

                    <?php
include 'main_footer.php';
?>

