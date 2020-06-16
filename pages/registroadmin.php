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

    if (isset($_POST['lugarguardar'])) {

        $nombre   = strtoupper($_POST["nombre"]);
        $apellido = strtoupper($_POST["apellido"]);
        $correo   = $_POST["correo"];
        $nivel    = strtoupper($_POST["nivel"]);
        $pass     = $_POST["pw"];
        $usua     = $_POST["usuario"];

        $sql = "SELECT * FROM administrador where correo='$correo'";

        $cs = $bd->consulta($sql);

        if ($bd->numeroFilas($cs) == 0) {

            $sql2 = "INSERT INTO `administrador` (`id`, `usuario`, `pass`, `nombre`, `apellido`, `correo`, `nive_usua`) VALUES (NULL, '$usua', '$pass', '$nombre', '$apellido', '$correo', '$nivel')";

            $cs = $bd->consulta($sql2);

            //echo "Datos Guardados Correctamente";
            echo '<div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>¡El administrador se registró correctamente!</b> ';

            echo '   </div>';

        } else {

//CONSULTAR SI EL CAMPO YA EXISTE

            echo '<div class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>¡Administrador no registrado, ya existe!</b> ';

            echo '   </div>';
        }

    }
    ?>
  <div class="col-md-10">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Registrar usuario</h3>
                                </div>
                                <!-- form start -->
                                <form role="form"  name="fe" action="?mod=registroadmin&nuevo=nuevo" method="post">
                                    <div class="box-body">
                                        <div class="form-group">

                                            <label for="exampleInputFile">Nombre</label>
                                            <input  onkeypress="return caracteres(event)" onblur="this.value=this.value.toUpperCase();" type="text" required type="tex" name="nombre" class="form-control" value="<?php echo $var2; ?>" id="exampleInputEmail1" placeholder="Nombre">
                                            <label for="exampleInputFile">Apellido</label>
                                            <input  onkeypress="return caracteres(event)" onblur="this.value=this.value.toUpperCase();" required type="tex" name="apellido" class="form-control" value="<?php echo $var3; ?>" id="exampleInputEmail1" placeholder="Apellido">

                                             <label for="exampleInputFile">Usuario</label>
                                            <input    required type="tex" name="usuario" class="form-control" value="<?php echo $var3; ?>" id="exampleInputEmail1" placeholder="Usuario">

                                            <label for="exampleInputFile">Clave</label>
                                            <input   required type="password" name="pw" class="form-control" value="<?php echo $var3; ?>" id="exampleInputEmail1" placeholder="Contraseña">

                                            <label for="exampleInputFile">Correo</label>
                                            <input  required type="email" name="correo" class="form-control" value="<?php echo $var4; ?>"  placeholder="Correo">

                                            <label for="exampleInputFile">Nivel de Usuario</label>
                                                <select  for="exampleInputEmail" class="form-control" name='nivel'>
     <option  value="1">Administrador</option>
     <option value="2">Invitado</option>
   </select>
                                        </div>
                                    </div><!-- /.box-body -->
                                    <center>
                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-primary btn-lg" name="lugarguardar" id="lugarguardar" value="Guardar">Agregar</button>
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
                                    <h3 class="box-title">Lista de usuarios</h3>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Nombre</th>
                                                <th>Apellido</th>
                                                <th>Correo</th>
                                                 <th>Nivel</th>
                                                <th>Acción</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
if ($tipo2 == 1) {

        $consulta = "SELECT id, nombre, apellido, correo, nive_usua FROM administrador ORDER BY id ASC ";
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
                                                              $fila[nombre]
                                                        </td>
                                                        <td> $fila[apellido]                                                        </td>
                                                        <td>
                                                            $fila[correo]
                                                        </td>
                                                         <td>
                                                            $fila[nive_usua]
                                                        </td>
                                                         <td><center>
                                                            <a  href=?mod=registroadmin&consultar&codigo=" . $fila["id"] . "><img src='./img/consul.png' width='25' alt='Edicion' title='Consultar" . $fila["nombre"] . "'></a>";

            echo "

      <a  href=?mod=registroadmin&editar&codigo=" . $fila["id"] . "><img src='./img/editar.png' width='25' alt='Edicion' title='Editar los datos de" . $fila["nombre"] . "'></a>
      <a   href=?mod=registroadmin&eliminar&codigo=" . $fila["id"] . "><img src='./img/elimina.png'  width='25' alt='Edicion' title='Eliminar a" . $fila["nombre"] . "'></a>
      ";

        }
        echo "    </center>     </td>
                                                    </tr>";

    }?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Nombre</th>
                                                <th>Apellido</th>
                                                <th>Correo</th>
                                                <th>Nivel</th>
                                                <th>Acción</th>
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
                            <form  name='fe' action='?mod=registroadmin&nuevo' method='post' id='ContactForm'>
 <input title='Agregar nuevo registro' name='btn1'  class='btn btn-primary' type='submit' value='Agregar nuevo'>

  </form>

                            </div>  "; ?>
                        </br>

  <div class="col-md-3">

                                </div>

<?php
}

if (isset($_GET['editar'])) {

//codigo que viene de la lista
    $x1 = $_GET['codigo'];
    if (isset($_POST['editar'])) {

        $nombre   = strtoupper($_POST["nombre"]);
        $apellido = strtoupper($_POST["apellido"]);
        $correo   = $_POST["correo"];
        $nivel    = strtoupper($_POST["nivel"]);
        $pass     = $_POST["pw"];
        $usuario  = $_POST["usuario"];

        if ($nombre == "") {

            echo "
   <script> alert('campos vacios')</script>
   ";
            echo "<br>";

        } else {

            $sql22 = " UPDATE administrador SET
nombre='$nombre' ,
apellido='$apellido' ,
nive_usua='$nivel' ,
correo='$correo',
usuario='$usuario'
 where id='$x1'";

            $bd->consulta($sql22);

            //echo "Datos Guardados Correctamente";
            echo '<div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>¡Los datos se han editado correctamente!</b>  ';

            echo '   </div>';

        }

    }

    $consulta = "SELECT usuario, nombre, apellido, correo, nive_usua FROM administrador where id='$x1'";
    $bd->consulta($consulta);
    while ($fila = $bd->mostrar_registros()) {

        ?>
  <div class="col-md-5">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Editar usuario </h3>
                                </div>
        <?php echo '  <form role="form"  name="fe" action="?mod=registroadmin&editar=editar&codigo=' . $x1 . '" method="post">';
        ?>
                                    <div class="box-body">
                                        <div class="form-group">

                                          <label for="exampleInputFile">Nombre</label>
                                          <input onkeypress="return caracteres(event)" onblur="this.value=this.value.toUpperCase();" type="text" required type="text" name="nombre" class="form-control" value=" <?php echo $fila['nombre']; ?>" id="exampleInputEmail1">

                                          <label for="exampleInputFile">Apellido</label>
                                          <input onkeypress="return caracteres(event)" onblur="this.value=this.value.toUpperCase();" required type="text" name="apellido" class="form-control" value=" <?php echo $fila['apellido']; ?>" id="exampleInputEmail1">

                                          <label for="exampleInputFile">Usuario</label>
                                          <input  required type="text" name="usuario" class="form-control" value=" <?php echo $fila['usuario']; ?>" id="exampleInputEmail1">

                                          <label for="exampleInputFile">Correo</label>
                                          <input required type="email" name="correo" class="form-control" value=" <?php echo $fila['correo']; ?>" id="exampleInputEmail1">

                                          <label for="exampleInputFile">Nivel de Usuario</label>
                                          <select  for="exampleInputEmail" class="form-control" name='nivel'>
                                            <option value="1">Administrador</option>
                                            <option value="2">Invitado</option>
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

//eliminar

if (isset($_GET['eliminar'])) {

//codigo que viene de la lista
    $x1 = $_GET['codigo'];
    if (isset($_POST['eliminar'])) {

        $nombre   = strtoupper($_POST["nombre"]);
        $apellido = strtoupper($_POST["apellido"]);
        $correo   = strtoupper($_POST["correo"]);
        $nivel    = strtoupper($_POST["nivel"]);
        $pass     = $_POST["pw"];
        $usuario  = $_POST["usuario"];

        if ($x1 == "") {

            echo "
   <script> alert('campos vacios')</script>
   ";
            echo "<br>";

        } else {

            $sql = "DELETE FROM administrador WHERE id='$x1' ";

            $bd->consulta($sql);

            //echo "Datos Guardados Correctamente";
            echo '<div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>¡Eliminado correctamente!</b>  ';

            echo '   </div>';

            ?><center>
                           <div class="box-footer">
                                    <a href="?mod=registroadmin&lista=lista" class="alert-link">Regresar a lista</a>
                                    </div>
                                    </center>
<?php
///////////////------////////////

        }
    }

    $consulta = "SELECT usuario,id,nive_usua, nombre, apellido, correo FROM administrador WHERE id='$x1'";
    $bd->consulta($consulta);
    while ($fila = $bd->mostrar_registros()) {

        ?>
  <center>
  <div class="col-md-5">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Eliminar usuario</h3>
                                </div>

        <?php echo '  <form role="form"  name="fe" action="?mod=registroadmin&eliminar&codigo=' . $x1 . '" method="post">';
        ?>
                            <div class="box-body">
                                <div class="form-group">
                            <div class="box-body">
                                <div class="form-group">
                                    <center>
                                      <table id="example1" class="table table-bordered table-striped">
                                            <tr>
                                              <td>
                                                <h3>Usuario</h3>
                                              </td>
                                            <td>
                                                <?php echo $fila['usuario']; ?>
                                            </td>
                                            </tr>
                                            <tr>
                                              <td>
                                                <h3>ID usuario</h3>
                                              </td>
                                            <td>
                                                <?php echo $fila['id']; ?>
                                            </td>
                                            </tr>
                                            <tr>
                                              <td>
                                                <h3>Nivel del usuario</h3>
                                              </td>
                                            <td>
                                                <?php echo $fila['nive_usua']; ?>
                                            </td>
                                            </tr>
                                            <tr>
                                              <td>
                                                <h3>Nombre</h3>
                                              </td>
                                            <td>
                                                <?php echo $fila['nombre']; ?>
                                            </td>
                                            </tr>
                                            <tr>
                                              <td>
                                                <h3>Apellido</h3>
                                              </td>
                                            <td>
                                                <?php echo $fila['apellido']; ?>
                                           </td>
                                           </tr>
                                           <tr>
                                              <td>
                                                <h3>Correo</h3>
                                              </td>
                                            <td>
                                                <?php echo $fila['correo']; ?>
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
                            <form  name="fe" action="?mod=registroadmin&lista=lista" method="post" id="ContactForm">
 <input title="Regresar a lista" name="btn1"  class="btn btn-primary"type="submit" value="Regresar a lista">
  </form>
  </center>
                                </div>
                            </div>
                            </div>  '; ?>
<?php

    }

}

if (isset($_GET['consultar'])) {

//codigo que viene de la lista
    $x1 = $_GET['codigo'];
    if (isset($_POST['consultar'])) {

    }
    $consulta = "SELECT usuario, id, nive_usua, nombre, apellido, correo FROM administrador WHERE id='$x1'";

    $bd->consulta($consulta);
    while ($fila = $bd->mostrar_registros()) {

        ?>
<center>
  <div class="col-md-5">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Consulta de usuarios</h3>
                                </div>
        <?php echo '  <form role="form"  name="fe" action="?mod=registroadmin&consultar&codigo=' . $x1 . '" method="post">';
        ?>
                            <div class="box-body">
                                <div class="form-group">
                                    <center>
                                      <table id="example1" class="table table-bordered table-striped">
                                            <tr>
                                              <td>
                                                <h3>Usuario</h3>
                                              </td>
                                            <td>
                                                <?php echo $fila['usuario']; ?>
                                            </td>
                                            </tr>
                                            <tr>
                                              <td>
                                                <h3>ID usuario</h3>
                                              </td>
                                            <td>
                                                <?php echo $fila['id']; ?>
                                            </td>
                                            </tr>
                                            <tr>
                                              <td>
                                                <h3>Nivel del usuario</h3>
                                              </td>
                                            <td>
                                                <?php echo $fila['nive_usua']; ?>
                                            </td>
                                            </tr>
                                            <tr>
                                              <td>
                                                <h3>Nombre</h3>
                                              </td>
                                            <td>
                                                <?php echo $fila['nombre']; ?>
                                            </td>
                                            </tr>
                                            <tr>
                                              <td>
                                                <h3>Apellido</h3>
                                              </td>
                                            <td>
                                                <?php echo $fila['apellido']; ?>
                                           </td>
                                           </tr>
                                           <tr>
                                              <td>
                                                <h3>Correo</h3>
                                              </td>
                                            <td>
                                                <?php echo $fila['correo']; ?>
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
                            <form  name="fe" action="?mod=registroadmin&lista=lista" method="post" id="ContactForm">
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



