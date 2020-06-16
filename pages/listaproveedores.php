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

if (isset($_GET['proveedores'])) {

    $x1 = $_GET['codigo'];

    if (isset($_POST['proveedores'])) {

    }
    ?>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Id proveedores</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Id Proveedor</th>
                                                <th>Nombre</th>
                                                <th>CIF</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
if ($tipo2 == 1 || $tipo2 == 2) {

        $consulta = "SELECT id_proveedores, nombre, cif FROM proveedores ORDER BY id_proveedores ASC ";
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
                                                                $fila[id_proveedores]
                                                        </td>
                                                        <td>
                                                            $fila[nombre]
                                                         </td>
                            <td>
                                                            $fila[cif]
                                                         </td>";
        }
    }?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Id Proveedor</th>
                                                <th>Nombre</th>
                                                <th>CIF</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                        </br>
  <div class="col-md-3">
                                </div>

<?php
}
?>
</div>
</div>
<?php
include 'main_footer.php';
?>



