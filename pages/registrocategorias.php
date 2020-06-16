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

    if (isset($_POST['regcategoria'])) {

        $id_categoria = strtoupper($_POST["id_categoria"]);
        $descripcion  = ($_POST["descripcion"]);
        $fechai       = $fecha2;

        $sql = "SELECT * FROM categoria WHERE descripcion = '$descripcion'";
        $cs  = $bd->consulta($sql);

        if ($bd->numeroFilas($cs) != 0) {

            $cs = mysql_query($sql, $cn);
            while ($resul = mysql_fetch_array($cs)) {
                $var6 = $resul[0];
            }

//CONSULTAR SI EL CAMPO YA EXISTE

            echo '<div class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>¡La categoría registrada ya existe!</b> ';

            echo '   </div>';

        } else {

            $sql2        = "INSERT INTO `categoria` (`id_categoria`, `descripcion` ) VALUES ('$id_categoria', '$descripcion')";
            $query_sql_2 = mysql_query($sql2);

            echo '<div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>¡La categoría se ha registrado correctamente!</b> ';
            echo '   </div>';
        }
    }
    ?>
  <div class="col-md-10">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Registrar categoría</h3>
                                </div><!-- form start -->
                                <form role="form"  name="fe" action="?mod=registrocategorias&nuevo=nuevo" method="post">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="exampleInputFile">Nombre de la categoría</label>
                                            <input required type="text" name="descripcion" class="form-control" value="<?php echo $var3; ?>" id="exampleInputEmail1" placeholder="Nombre categoría">
                                        </div>
                                    </div><!-- /.box-body -->
                                    <center>
                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-primary btn-lg" name="regcategoria" id="regcategoria" value="Guardar">Agregar</button>
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
                        <div class="col-xs-8">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Lista de categorías</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Id categoría</th>
                                                <th>Descripción categoría</th>
                                                <th>Opciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
if ($tipo2 == 1 || $tipo2 == 2) {

        $consulta = "SELECT id_categoria, descripcion FROM categoria ORDER BY id_categoria ASC";
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
            echo " <tr>
                                                        <td>
                                                            $fila[id_categoria]
                                                        </td>
                                                        <td>
                                                            $fila[descripcion]
                                                        </td>
                                                        <td>
                                                            <center>
                                                                <a  href=?mod=registrocategorias&editar&codigo=" . $fila["id_categoria"] . "><img src='./img/editar.png' width='25' alt='Edicion' title='Editar " . $fila["descripcion"] . "'></a> ";

            /*echo "

        <a  href=?mod=registrocategorias&eliminar&codigo=" . $fila["id_categoria"] . "><img src='./img/elimina2.png' width='25' alt='Edicion' title='Eliminar " . $fila["descripcion"] . "'></a>
        ";*/}
        echo "      </center>
                                                        </td>
                                                    </tr>";

    } else {

        $consulta = "SELECT id_categoria, descripcion FROM categoria ORDER BY id_categoria ASC";
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
                                                            $fila[id_categoria]
                                                        </td>
                                                        <td>
                                                            $fila[descripcion]
                                                        </td>
                                                    </tr>";
        }

    }?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Id categoría</th>
                                                <th>Descripción categoría</th>
                                                <th>Opciones</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>

                            <?php
if ($tipo2 == 1 || $tipo2 == 2) {
        echo "
  <div class='col-xs-6'>
  <div class='dataTables_paginate paging_bootstrap'>
                                </div>
                            <form  name='fe' action='?mod=registrocategorias&nuevo' method='post' id='ContactForm'>
 <input title='Agregar nueva categoría' name='btn1'  class='btn btn-primary' type='submit' value='Agregar nueva'>
  </form>
                            </div>  ";}?>
                        </br>
<?php
}

if (isset($_GET['editar'])) {

//Codigo que viene de la lista
    $x1 = $_GET['codigo'];
    if (isset($_POST['editar'])) {

        $id_categoria = strtoupper($_POST["id_categoria"]);
        $descripcion  = ($_POST["descripcion"]);

        $sql = "SELECT * FROM `categoria` WHERE id_categoria='$id_categoria'";

        if ($id_categoria && $descripcion == "") {

            echo "
   <script> alert('campos vacios')</script>
   ";
            echo "<br>";

        } else {
            $sql = "UPDATE categoria SET
descripcion='$descripcion'
WHERE id_categoria='$x1'";

            $bd->consulta($sql);

            //echo "Datos Guardados Correctamente";
            echo '<div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>¡Los datos se han guardado correctamente!</b> ';
            echo '   </div>';

        }

    }

    $consulta = "SELECT descripcion FROM categoria WHERE id_categoria='$x1'";
    $bd->consulta($consulta);
    while ($fila = $bd->mostrar_registros()) {

        ?>
  <div class="col-md-5">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Editar categorías</h3>
                                </div>

        <?php echo '  <form role="form"  name="fe" action="?mod=registrocategorias&editar=editar&codigo=' . $x1 . '" method="post">';
        ?>
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="exampleInputFile">Descripción</label>
                                                <input required type="text" name="descripcion" class="form-control" value="<?php echo $fila['descripcion']; ?>" id="exampleInputEmail" placeholder="Descripción">
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

//Eliminar
if (isset($_GET['eliminar'])) {

//Codigo que viene de la lista
    $x1 = $_GET['codigo'];
    if (isset($_POST['eliminar'])) {

        $id_categoria = ($_POST["id_categoria"]);
        $descripcion  = ($_POST["descripcion"]);

        $total  = mysql_fetch_row(mysql_query("SELECT id_categoria FROM productos WHERE id_categoria='$id_categoria'"));
        $numero = 0;

        $bd->consulta($total);

        if ($total != $numero) {

            echo "
   <script> alert('No puedes borrar esta categoría porque contiene productos dentro')</script>
   ";
            echo "<br>";

        } else {

            $sql = "DELETE FROM categoria WHERE id_categoria='$x1'";

            $bd->consulta($sql);

            //echo "Datos Guardados Correctamente";
            echo '<div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>¡Se ha eliminado correctamente!</b> ';

            echo '   </div>';

            echo '
                  <div class="col-md-3">
                  <div class="box">
                                                <div class="box-header">
                                                <div class="box-header">
                                                    <h3> <center>Regresar a lista<a href="#" class="alert-link"></a></center></h3>
                                                </div>
                                        <center>
                                            <form  name="fe" action="?mod=registrocategorias&lista=lista" method="post" id="ContactForm">
                 <input title="Regresar a lista" name="btn1"  class="btn btn-primary"type="submit" value="Regresar a lista">
                  </form>
                  </center>
                                                </div>
                                            </div>
                                            </div>  ';

        }

    }

    $consulta = "SELECT id_categoria, descripcion FROM categoria WHERE id_categoria='$x1'";
    $bd->consulta($consulta);
    while ($fila = $bd->mostrar_registros()) {

        ?>
<center>
  <div class="col-md-5">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Eliminar categoría</h3>
                                </div>


        <?php echo '  <form role="form"  name="fe" action="?mod=registrocategorias&eliminar&codigo=' . $x1 . '" method="post">';
        ?>
                            <div class="box-body">
                                <div class="form-group">
                            <div class="box-body">
                                <div class="form-group">
                                    <center>
                                      <table id="example1" class="table table-bordered table-striped">
                                            <tr>
                                              <td>
                                                <h3>Id Categoría</h3>
                                              </td>
                                            <td>
                                                <?php echo $fila['id_categoria']; ?>
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
                            <form  name="fe" action="?mod=registrocategorias&lista=lista" method="post" id="ContactForm">



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
</div>
</div>
<?php
include 'main_footer.php';
?>


