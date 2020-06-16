<!DOCTYPE html>
<html class="lockscreen">
    <head>
        <meta charset="UTF-8">
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    </head>
<?php

require 'validarnum.php';

$fecha2 = date("Y-m-d");

if (isset($_GET['nuevo'])) {

    if (isset($_POST['nuevo'])) {

        $nombre       = strtoupper($_POST["nombre"]);
        $descripcion  = strtoupper($_POST["descripcion"]);
        $marca        = $_POST["marca"];
        $precio       = strtoupper($_POST["precio"]);
        $id_proveedor = strtoupper($_POST["id_proveedor"]);
        $id_categoria = strtoupper($_POST["id_categoria"]);

        $sql = "SELECT * FROM productos WHERE modelo='$nombre' AND descripcion='$descripcion'";

        $cs = $bd->consulta($sql);

        if ($bd->numeroFilas($cs) == 0) {

            $sql2 = "INSERT INTO `productos` ( `modelo`, `descripcion`, `marca`, `precio`, `id_proveedor`, `id_categoria`) VALUES ( '$nombre', '$descripcion', '$marca', '$precio', '$id_proveedor', '$id_categoria')";
            $cs   = $bd->consulta($sql2);

            //echo "Datos Guardados Correctamente";
            echo '<div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>¡El producto se ha registrado correctamente!</b>';
            echo '   </div>';

        } else {

//CONSULTAR SI EL CAMPO YA EXISTE
            echo '<div class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>¡Este producto ya existe!</b>';
            echo '   </div>';
        }
    }
    ?>
  <div class="col-md-10">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Registrar productos</h3>
                                </div>
                                <!-- form start -->
                                <form role="form"  name="fe" action="?mod=registroproductos&nuevo=nuevo" method="post">
                                    <div class="box-body">
                                      <div class="form-group">


                                            <label for="exampleInputFile">Modelo</label>
                                            <input onkeypress="return caracteres(event)" onblur="this.value=this.value.toUpperCase();" type="text" required type="tex" name="nombre" class="form-control" value="<?php echo $var2; ?>" id="exampleInputEmail1" placeholder="Modelo">

                                            <label for="exampleInputFile">Descripción</label>
                                            <input onblur="this.value=this.value.toUpperCase();" required type="tex" name="descripcion" class="form-control" value="<?php echo $var3; ?>" id="exampleInputEmail1" placeholder="Descripción">

                                             <label for="exampleInputFile">Marca</label>
                                            <input  onblur="this.value=this.value.toUpperCase();" required type="tex" name="marca" class="form-control" value="<?php echo $var3; ?>" id="exampleInputEmail1" placeholder="Marca">

                                            <label for="exampleInputFile">Precio</label>
                                            <input onkeydown="return dosDecimales(this, event)" required type="text" name="precio" class="form-control" value="<?php echo $var1; ?>" id="exampleInputEmail1" placeholder="Precio">

                                            <label for="exampleInputFile">Proveedor</label>
                                                <select for="exampleInputEmail" class="form-control" name='id_proveedor'>
                                                <?php
$query = "SELECT * FROM proveedores order by id_proveedores asc";

    $result = mysql_query($query);

    while ($row = mysql_fetch_array($result)) {

        ?>
<option value=<?php echo $row['id_proveedores']; ?>> <?php echo $row['nombre']; ?> </option>
<?php
}
    ;?>
                                              </select>

                                           <label for="exampleInputFile">Categoría</label>
                                              <select for="exampleInputEmail" class="form-control" name='id_categoria'>
                                                <?php
$query = "SELECT * FROM categoria order by id_categoria asc";

    $result = mysql_query($query);

    while ($row = mysql_fetch_array($result)) {

        ?>

<option value=<?php echo $row['id_categoria']; ?>> <?php echo $row['descripcion']; ?> </option>
<?php
}
    ;?>
                                              </select>
                                        </div>
                                    </div><!-- /.box-body -->
                                    <center>
                                    <div class="box-footer">
                                      <button type="submit" class="btn btn-primary btn-lg" name="nuevo" id="nuevo" value="Guardar">Agregar</button>
                                    </div>
                                    </center>
                                </form>
                            </div><!-- /.box -->
<?php
}

if (isset($_GET['lista'])) {

    $x1 = $_GET['codigo'];

    if (isset($_POST['lista'])) {

    }
    ?>
                    <div class="row">
                        <div class="col-md-6">

                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Lista de productos y accesorios</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Proveedor</th>
                                                <th>Nombre</th>
                                                <th>Modelo</th>
                                                <th>Marca</th>
                                                <th>Categoría</th>
                                                <th>Precio</th>
                                                <th>Cantidad</th>
                                                <th>Opciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
if ($tipo2 == 1 || $tipo2 == 2) {

        $consulta = "SELECT id_productos, descripcion, modelo, precio, cantidad, marca, id_categoria, id_proveedor FROM productos ORDER BY id_productos ASC ";

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
                                                            $fila[id_proveedor]
                                                        </td>
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
                                                            $fila[id_categoria]
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
       <a  href=?mod=registromovimientos&descargo&codigo=" . $fila["id_productos"] . "><img src='./img/descargo.png' width='25' alt='Edicion' title='Descargar cantidad a " . $fila["descripcion"] . "'></a>
      ";
            }
        }
        echo "    </center>     </td>
                                                    </tr>";

    }?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Proveedor</th>
                                                <th>Nombre</th>
                                                <th>Modelo</th>
                                                <th>Marca</th>
                                                <th>Categoría</th>
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

    if ($tipo2 == 1 || $tipo2 == 2) {
        echo '
<div class="col-xs-6">
    <div class="dataTables_paginate paging_bootstrap">
</div>

<form  name="fe" action="?mod=registroproductos&nuevo" method="post" id="ContactForm">
    <input title="Agregar nuevo producto" name="btn1"  class="btn btn-primary" type="submit" value="Agregar nuevo">
</form>
    </div>  ';

    }?>
                        </br>

  <?php
echo '

<div class="col-xs-6" id="imprimir">
    <div class="dataTables_paginate paging_bootstrap">
        <a target="_blank"  href=./pdf/listaequipos.php><img src="./img/impresora.png"  width="50" alt="Edicion" title="Imprimir lista de productos"></a>
    </div>
</div>

                                '; ?>

<?php

}

if (isset($_GET['editar'])) {

    $x1 = $_GET['codigo'];

    if (isset($_POST['editar'])) {

        $nombre       = strtoupper($_POST["nombre"]);
        $descripcion  = strtoupper($_POST["descripcion"]);
        $marca        = $_POST["marca"];
        $precio       = strtoupper($_POST["precio"]);
        $id_categoria = strtoupper($_POST["id_categoria"]);
        $id_proveedor = strtoupper($_POST["id_proveedor"]);

        if (trim($nombre) == "" || trim($descripcion) == "" || trim($marca) == "" || trim($precio) == "") {

            echo '<div class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>¡Debes rellenar todos los campos!</b>';
            echo '   </div>';

        } else {

            $sql22 = "UPDATE productos SET modelo = '$nombre', descripcion = '$descripcion', marca = '$marca', precio = '$precio', id_proveedor ='$id_proveedor', id_categoria = '$id_categoria' WHERE id_productos='$x1'";
            $bd->consulta($sql22);

            echo '<div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>¡Los datos se editaron correctamente!</b>';
            echo '   </div>';
        }
    }

    $consulta = "SELECT id_productos, modelo, descripcion, marca, precio, id_proveedor, id_categoria FROM productos WHERE id_productos='$x1'";
    $bd->consulta($consulta);
    while ($fila = $bd->mostrar_registros()) {

        ?>
  <div class="col-md-5">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Editar producto o accesorio </h3>
                                </div>


        <?php echo '  <form role="form"  name="fe" action="?mod=registroproductos&editar=editar&codigo=' . $x1 . '" method="post">';
        ?>
                                    <div class="box-body">
                                        <div class="form-group">

                                            <label for="exampleInputFile">Modelo</label>
                                            <input onkeypress="return caracteres(event)" onblur="this.value=this.value.toUpperCase();" type="text" required type="tex" name="nombre" class="form-control" value="<?php echo $fila['modelo']; ?>" id="exampleInputEmail1" placeholder="Nombre">

                                            <label for="exampleInputFile">Descripción</label>
                                            <input   required type="tex" name="descripcion" class="form-control" value="<?php echo $fila['descripcion']; ?>" id="exampleInputEmail1" placeholder="Descripción">

                                            <label for="exampleInputFile">Marca</label>
                                            <input required type="tex" name="marca" class="form-control" value="<?php echo $fila['marca']; ?>" id="exampleInputEmail1" placeholder="Marca">

                                            <label for="exampleInputFile">Precio</label>
                                            <input onkeydown="return dosDecimales(this, event)" required type="text" name="precio" class="form-control" value="<?php echo $fila['precio']; ?>" id="exampleInputEmail1" placeholder="Precio">

                                            <label for="exampleInputFile">Proveedor</label>
                                              <select for="exampleInputEmail" class="form-control" name='id_proveedor'>
                                                <?php
$query = "SELECT * FROM proveedores order by id_proveedores asc";

        $result = mysql_query($query);

        while ($row = mysql_fetch_array($result)) {

            if (strcmp($row['id_proveedores'], $fila['id_proveedor']) == 0) {?>

<option value=<?php echo $row['id_proveedores']; ?> selected> <?php echo $row['nombre']; ?> </option>

<?php
} else {
                ?>
    <option value=<?php echo $row['id_proveedores']; ?>> <?php echo $row['nombre']; ?> </option>
    <?php
}

        }
        ;?>
                                              </select>

                                            <label for="exampleInputFile">Categoría</label>
                                              <select for="exampleInputEmail" class="form-control" name='id_categoria'>
                                                <?php
$query = "SELECT * FROM categoria order by id_categoria asc";

        $result = mysql_query($query);

        while ($row = mysql_fetch_array($result)) {

            if (strcmp($row['id_categoria'], $fila['id_categoria']) == 0) {?>

<option value=<?php echo $row['id_categoria']; ?> selected> <?php echo $row['descripcion']; ?> </option>

<?php
} else {
                ?>
    <option value=<?php echo $row['id_categoria']; ?>> <?php echo $row['descripcion']; ?> </option>
    <?php
}

        }
        ;?>
                                              </select>
                                        </div>
                                    </div><!-- /.box-body -->
                                    <center>
                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-primary btn-lg" name="editar" id="editar" value="Editar">Editar</button>
                                    </div>
                                  </center>
                                </form>
                            </div><!-- /.box -->
  <?php
}
}

if (isset($_GET['eliminar'])) {

    $x1 = $_GET['codigo'];

    if (isset($_POST['eliminar'])) {

        $nombre       = strtoupper($_POST["nombre"]);
        $descripcion  = strtoupper($_POST["descripcion"]);
        $marca        = $_POST["marca"];
        $precio       = strtoupper($_POST["precio"]);
        $id_proveedor = $_POST["id_proveedor"];
        $id_categoria = strtoupper($_POST["id_categoria"]);

        if ($x1 == "") {

            echo "
   <script> alert('error')</script>
   ";
            echo "<br>";

        } else {

            $sql = "DELETE FROM productos WHERE id_productos='$x1' ";

            $bd->consulta($sql);

            //echo "Datos Guardados Correctamente";
            echo '<div class="alert alert-success alert-dismissable">
                        <i class="fa fa-check"></i>
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <b>¡El producto se ha eliminado correctamente!</b>';

            echo '   </div>';

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
</div>';

        }
    }

    $consulta = "SELECT id_productos, modelo, descripcion, marca, precio, id_proveedor, id_categoria, cantidad FROM productos WHERE id_productos='$x1'";
    $bd->consulta($consulta);
    while ($fila = $bd->mostrar_registros()) {

        ?>
<center>
  <div class="col-md-5">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Eliminar producto</h3>
                                </div>


        <?php echo '  <form role="form"  name="fe" action="?mod=registroproductos&eliminar=eliminar&codigo=' . $x1 . '" method="post">';
        ?>
                              <div class="box-body">
                                  <div class="form-group">
                                    <center>
                                      <table id="example1" class="table table-bordered table-striped">

                                            <tr>
                                              <td>
                                                <h3> Modelo</h3>
                                              </td>
                                              <td>
                                                <?php echo $fila['modelo']; ?>
                                              </td>
                                            </tr>
                                            <tr>
                                              <td>
                                                <h3>Descripción</h3>
                                              </td>
                                            <td>
                                                <?php echo $fila['descripcion']; ?>
                                            </td>
                                            </tr>
                                            <tr>
                                              <td>
                                                <h3>Marca</h3></td>
                                            <td>
                                                <?php echo $fila['marca']; ?>
                                           </td>
                                            </tr>
                                            <tr>
                                              <td>
                                                <h3>Precio</h3>
                                              </td>
                                            <td>
                                                <?php echo $fila['precio']; ?>
                                            </td>
                                            </tr>
                                           <tr>
                                              <td>
                                                <h3>Proveedor</h3>
                                              </td>
                                            <td>
                                                <?php echo $fila['id_proveedor']; ?>
                                            </td>
                                            </tr>
                                            <tr>
                                              <td>
                                                <h3>Categoría</h3>
                                              </td>
                                            <td>
                                                <?php echo $fila['id_categoria']; ?>
                                            </td>
                                            </tr>
                                            <tr>
                                              <td>
                                                <h3>Cantidad</h3>
                                              </td>
                                            <td>
                                                <?php echo $fila['cantidad']; ?>
                                            </td>
                                            </tr>

                                    </table>
                                  </center>
                                </div>
                              </div><!-- /.box-body -->

                                    <div class="box-footer">
                                        <input type=submit  class="btn btn-primary btn-lg" name="eliminar" id="eliminar" value="Eliminar">
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
</div>'; ?>


<?php

    }
}

if (isset($_GET['consultar'])) {

    $x1 = $_GET['codigo'];

    if (isset($_POST['consultar'])) {

    }

    $consulta = "SELECT id_productos, modelo, descripcion, marca, precio, id_proveedor, id_categoria, cantidad FROM productos where id_productos='$x1'";
    $bd->consulta($consulta);
    while ($fila = $bd->mostrar_registros()) {

        ?>
<center>
  <div class="col-md-5">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Consulta de productos</h3>
                                </div>


        <?php echo '  <form role="form"  name="fe" action="?mod=registroproductos&eliminar=eliminar&codigo=' . $x1 . '" method="post">';
        ?>
                                    <div class="box-body">
                                        <div class="form-group">
                                            <center>

                                            <table id="example1" class="table table-bordered table-striped">
                                            <tr>
                                              <td>
                                                <h3> Modelo</h3>
                                              </td>
                                              <td>
                                                <?php echo $fila['modelo']; ?>
                                              </td>
                                            </tr>
                                            <tr>
                                              <td>
                                                <h3>Descripción</h3>
                                              </td>
                                            <td>
                                                <?php echo $fila['descripcion']; ?>
                                            </td>
                                            </tr>
                                            <tr>
                                              <td>
                                                <h3>Marca</h3></td>
                                            <td>
                                                <?php echo $fila['marca']; ?>
                                           </td>
                                            </tr>
                                            <tr>
                                              <td>
                                                <h3>Precio</h3>
                                              </td>
                                            <td>
                                                <?php echo $fila['precio']; ?>
                                            </td>
                                            </tr>
                                           <tr>
                                              <td>
                                                <h3>Proveedor</h3>
                                              </td>
                                            <td>
                                                <?php echo $fila['id_proveedor']; ?>
                                            </td>
                                            </tr>
                                            <tr>
                                              <td>
                                                <h3>Categoría</h3>
                                              </td>
                                            <td>
                                                <?php echo $fila['id_categoria']; ?>
                                            </td>
                                            </tr>
                                            <tr>
                                              <td>
                                                <h3>Cantidad</h3>
                                              </td>
                                            <td>
                                                <?php echo $fila['cantidad']; ?>
                                            </td>
                                            </tr>
                                            </table>
                                         </center>
                                    </div>
                                    </div><!-- /.box-body -->
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
</div>  '; ?>

<?php

    }
}
?>
                            <?php
;?>
</div>
</center>
</div>
<?php
include 'main_footer.php';
?>
