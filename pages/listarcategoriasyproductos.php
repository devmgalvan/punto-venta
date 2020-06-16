<!DOCTYPE html>
<html class="lockscreen">
    <head>
        <meta charset="UTF-8">
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    </head>
<?php

require 'validarnum.php';
$fecha2 = date("Y-m-d");

$query = "SELECT * FROM categoria order by id_categoria asc";

$result = mysql_query($query);

if (isset($_GET['listar'])) {

    $x1 = $_GET['codigo'];

    if (isset($_POST['listar'])) {

    }
    ?>
                    <div class="row">
                        <div class="col-xs-8">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Listar productos por categoría</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Descripión producto</th>
                                                <th>Marca</th>
                                                <th>Cantidad</th>
                                                <th>Id categoría</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
if ($tipo2 == 1 || $tipo2 == 2) {

        $categoria_filtrar = "";
        $consulta          = "";

        if (isset($_POST['categoria'])) {

            $categoria_filtrar = $_POST['categoria'];

            if ($categoria_filtrar != 0) {

                $consulta = "SELECT `modelo`, `id_categoria`, `marca`, `cantidad` FROM productos WHERE `id_categoria`=$categoria_filtrar";

            } else {

                $consulta = "SELECT `modelo`, `id_categoria`, `marca`, `cantidad` FROM productos WHERE `id_categoria`";
            }
        } else {

            $consulta = "SELECT `modelo`, `id_categoria`, `marca`, `cantidad` FROM productos WHERE `id_categoria`";
        }

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
                                                            $fila[marca]
                                                          </td>
                                                          <td>
                                                            $fila[cantidad]
                                                          </td>
                                                        <td>
                                                            $fila[id_categoria]
                                                        </td>
                                                         </tr>";
        }
    }
}?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Descripión producto</th>
                                                <th>Marca</th>
                                                <th>Cantidad</th>
                                                <th>Id categoría</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    <form role="form" name="fe" action="index.php?mod=listarcategoriasyproductos&listar" method="post">
                                            <select for="exampleInputEmail" class="form-control" name='categoria'>
                                                <option value="0">-Cargar de nuevo toda la lista-</option>
                                                <?php
while ($row = mysql_fetch_array($result)) {

    if (strcmp($row['id_categoria'], $categoria_filtrar) == 0) {?>

<option value=<?php echo $row['id_categoria']; ?> selected> <?php echo $row['descripcion']; ?> </option>

<?php
} else {
        ?>

<option value=<?php echo $row['id_categoria']; ?>> <?php echo $row['descripcion']; ?> </option>

<?php
}
}
?>
                                              </select>
                                              <br>
                                              <center>
          <input type="submit" class="btn btn-primary btn-lg active" name="filtrar_categoria" role="button" value="Filtrar" aria-pressed="true">
                                    </center>
                                    </form>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>
                        </br>

                    </div>

<?php
include 'main_footer.php';
?>