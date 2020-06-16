<!DOCTYPE html>
<html class="lockscreen">
    <head>
        <meta charset="UTF-8">
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    </head>
<?php

require 'validarnum.php';

if (isset($_GET['changepass'])) {

    if (isset($_POST['changesave'])) {

        $oldpass        = ($_POST["oldpass"]);
        $newpass        = ($_POST["newpass"]);
        $confirmar_pass = ($_POST["confirmar_pass"]);

        $resp      = mysql_query("SELECT pass FROM administrador WHERE pass='$oldpass'");
        $row       = mysql_fetch_array($resp);
        $passvieja = $row["oldpass"];

        if ($row == "") {

            echo '<div class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-times"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>¡Contraseña actual incorrecta!</b> ';
            echo '   </div>';

        } else {

            if ($oldpass == $newpass && $oldpass == $confirmar_pass) {

                echo '<div class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-times"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>¡La contraseña nueva es igual a la anterior!</b> ';
                echo '   </div>';

            } else {

                if ($_POST['newpass'] != $_POST['confirmar_pass']) {

                    echo '<div class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-times"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>¡Las contraseñas ingresadas no coinciden!</b> ';
                    echo '   </div>';

                } else {

                    if ($newpass != $passvieja) {

                        mysql_query("UPDATE administrador SET pass='$newpass' WHERE pass='$oldpass'");

                        $bd->consulta($resp);

                        echo '<div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>¡La contraseña se ha cambiado correctamente!</b> ';
                        echo '   </div>';

                    } else {

                        echo '<div class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-times"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>¡La contraseña no se ha cambiado!</b> ';

                        echo '   </div>';
                    }

                    /*if ($newpass != $passvieja) {

                mysql_query("UPDATE administrador SET pass='$newpass' WHERE pass='$oldpass'");

                $bd->consulta($resp);

                echo '<div class="alert alert-success alert-dismissable">
                <i class="fa fa-check"></i>
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <b>¡La contraseña se ha cambiado correctamente!</b> ';

                echo '   </div>';

                } else {

                echo '<div class="alert alert-danger alert-dismissable">
                <i class="fa fa-check"></i>
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <b>¡Las contraseñas son iguales!</b> ';

                echo '   </div>';
                }*/
                }
            }
        }
    }
}

?>
 <div class="col-xs-6">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Cambiar contraseña</h3>
                                </div><!-- form start -->
                                <form role="form"  name="fe" action="?mod=profile_user&changepass" method="post">
                                    <div class="box-body">
                                        <div class="form-group">

                                            <label for="exampleInputFile">Actual contraseña</label>
                                            <input type="password" onkeypress="return caracteres(event)" required type="text" name="oldpass" class="form-control" id="exampleInputEmail1">

                                            <label for="exampleInputFile">Nueva contraseña</label>
                                            <input type="password" onkeypress="return caracteres(event)" required type="text" name="newpass" class="form-control" id="exampleInputEmail1">

                                            <label for="exampleInputFile">Confirmar contraseña</label>
                                            <input type="password" onkeypress="return caracteres(event)" required type="text" name="confirmar_pass" class="form-control" id="exampleInputEmail1">
                                            </div>
                                    </div><!-- /.box-body -->
                                    <center>
                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-primary btn-lg" name="changesave" id="changesave" value="Guardar">Guardar cambios</button>
                                    </div>
                                    </center>
                                </form>
                            </div><!-- /.box -->
                        </div>
                    </div>
                </div>
<?php
include 'main_footer.php';
?>

<!--<script language="javascript">
location.href = "index.php";
</script>-->
