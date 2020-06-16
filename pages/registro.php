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

        $nombre            = strtoupper($_POST["nombre"]);
        $provincia         = strtoupper($_POST["provincia"]);
        $cp                = ($_POST["cp"]);
        $personal_contacto = strtoupper($_POST["personal_contacto"]);
        $movil             = strtoupper($_POST["movil"]);
        $poblacion         = strtoupper($_POST["poblacion"]);
        $correo            = strtoupper($_POST["correo"]);
        $ci                = strtoupper($_POST["ci"]);
        $direccion         = strtoupper($_POST["direccion"]);
        $telefono          = strtoupper($_POST["telefono"]);
        $fechai            = $fecha2;

        $sql = "SELECT * FROM `proveedores` WHERE cif='$ci'";
        $cs  = $bd->consulta($sql);

        if ($bd->numeroFilas($cs) != 0) {

            $cs = mysql_query($sql, $cn);
            while ($resul = mysql_fetch_array($cs)) {
                $var6 = $resul[0];
            }

            echo '<div class="alert alert-danger alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>¡El proovedor registrado ya existe!</b> ';

            echo '   </div>';
        } else {

            $sql2 = "INSERT INTO `proveedores` ( `cif`, `nombre`, `provincia`, `cp`, `personal_contacto`, `movil`, `poblacion`, `correo`, `fechai`, `telefono`, `direccion` )

        VALUES ( '$ci', '$nombre', '$provincia', '$cp', '$personal_contacto', '$movil', '$poblacion', '$correo', '$fechai', '$telefono', '$direccion' )";

            $cs = $bd->consulta($sql2);
            // $cs=mysql_query($sql,$cn);

            //echo "Datos Guardados Correctamente";
            echo '<div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>¡Los datos se han guardado correctamente!</b> ';

            echo '   </div>';

        }

    }
    ?>
  <div class="col-md-10">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Registrar proveedores</h3>
                                </div><!-- form start -->
                                <form role="form"  name="fe" action="?mod=registro&nuevo=nuevo" method="post">
                                    <div class="box-body">
                                        <div class="form-group">

                                            <label for="exampleInputFile">Nombre</label>
                                            <input onkeypress="return caracteres(event)" onblur="this.value=this.value.toUpperCase();" type="text" required type="text" name="nombre" class="form-control" value="<?php echo $var2; ?>" id="exampleInputEmail1" placeholder="Nombre">

                                            <label for="exampleInputFile">CIF</label>
                                            <input onkeypress="return caracteres(event)" required type="text" name="ci" class="form-control" value="<?php echo $var1; ?>" id="exampleInputEmail1" placeholder="CIF">

                                            <label for="exampleInputFile">Persona de contacto</label>
                                            <input onkeypress="return caracteres(event)" onblur="this.value=this.value.toUpperCase();" type="text" required type="text" name="personal_contacto" class="form-control" value="<?php echo $var2; ?>" id="exampleInputEmail1" placeholder="Persona contacto">

                                            <label for="exampleInputFile">Población</label>
                                            <input onkeypress="return caracteres(event)" onblur="this.value=this.value.toUpperCase();" required type="text" name="poblacion" class="form-control" value="<?php echo $var3; ?>" id="exampleInputEmail1" placeholder="Poblacion">

                                            <label for="exampleInputFile">Provincia</label>
                                            <input onkeypress="return caracteres(event)" onblur="this.value=this.value.toUpperCase();" required type="text" name="provincia" class="form-control" value="<?php echo $var3; ?>" id="exampleInputEmail1" placeholder="Provincia">

                                            <label for="exampleInputFile">Código Postal</label>
                                            <input onkeypress="return caracteres(event)" required type="text" name="cp" class="form-control" value="<?php echo $var2; ?>" id="exampleInputEmail1" placeholder="Código postal">

                                            <label for="exampleInputFile">Dirección</label>
                                            <input onkeydown="return caracteres(event)" onblur="this.value=this.value.toUpperCase();" required type="text" name="direccion" class="form-control" value="<?php echo $var2; ?>" id="exampleInputEmail1" placeholder="Dirección">

                                            <label for="exampleInputFile">Teléfono</label>
                                            <input onkeydown="return enteros(this, event)" required type="text" name="telefono" class="form-control" value="<?php echo $var1; ?>" id="exampleInputEmail1" placeholder="Teléfono">

                                            <label for="exampleInputFile">Móvil</label>
                                            <input onkeydown="return enteros(this, event)" required type="text" name="movil" class="form-control" value="<?php echo $var1; ?>" id="exampleInputEmail1" placeholder="Móvil">

                                            <label for="exampleInputFile">Correo</label>
                                            <input required type="email" name="correo" class="form-control" value="<?php echo $var4; ?>"  placeholder="Correo">
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
                        <div class="col-md-6">

                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Lista de proveedores</h3>
                                </div><!-- /.box-header -->

                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>CIF</th>
                                                <th>Nombre</th>
                                                <th>Población</th>
                                                <th>Dirección</th>
                                                <th>CP</th>
                                                <th>Teléfono</th>
                                                <th>Correo</th>
                                                <th>Acción</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
if ($tipo2 == 1 || $tipo2 == 2) {

        $consulta = "SELECT cif, nombre, poblacion, direccion, cp, telefono, correo, id_proveedores FROM proveedores ORDER BY cif ASC";
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
                                                            $fila[cif]
                                                        </td>

                                                        <td>
                                                            $fila[nombre]
                                                        </td>

                                                        <td>
                                                            $fila[poblacion]
                                                        </td>

                                                        <td>
                                                            $fila[direccion]
                                                        </td>

                                                        <td>
                                                            $fila[cp]
                                                        </td>

                                                        <td>
                                                            $fila[telefono]
                                                        </td>

                                                        <td>
                                                            $fila[correo]
                                                        </td>

                                                        <td>
                                                            <center>
                                                                <a  href=?mod=registro&consultar&codigo=" . $fila["id_proveedores"] . "><img src='./img/consul.png' width='25' alt='Edicion' title='Ver los datos de " . $fila["nombre"] . "'></a> ";

            echo "

      <a  href=?mod=registro&editar&codigo=" . $fila["id_proveedores"] . "><img src='./img/editar.png' width='25' alt='Edicion' title='Editar los datos de " . $fila["nombre"] . "'></a>
      <a  href=?mod=registro&eliminar&codigo=" . $fila["id_proveedores"] . "><img src='./img/elimina.png'  width='25' alt='Edicion' title='Eliminar a " . $fila["nombre"] . "'></a>
      ";}
        echo "      </center>
                                                        </td>
                                                    </tr>";

    } else {

        $consulta = "SELECT cif, nombre, poblacion, direccion, cp, telefono, correo, id_proveedores FROM proveedores ORDER BY cif ASC";
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

                                                        <td>
                                                            $fila[poblacion]
                                                        </td>

                                                        <td>
                                                            $fila[direccion]
                                                        </td>

                                                        <td>
                                                            $fila[cp]
                                                        </td>

                                                        <td>
                                                            $fila[telefono]
                                                        </td>

                                                        <td>
                                                            $fila[correo]
                                                        </td>

                                                        <td>
                                                            <a  href=prestacion2.php?codigo=" . $fila["cif"] . "><img src='./img/consul.png' width='25' alt='Edicion' title=' Consultar" . $fila["nombre"] . "'></a>";

            echo "

      <a target='_blank'  href=./pdf/.php?codigo=" . $fila["cif"] . "><img src='./img/impresora.png'  width='25' alt='Edicion' title='Imprimir reporte de prestaciones de" . $fila["nombre"] . "'></a>
                                                        </td>
                                                    </tr>";
        }

    }?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>CIF</th>
                                                <th>Nombre</th>
                                                <th>Población</th>
                                                <th>Dirección</th>
                                                <th>CP</th>
                                                <th>Teléfono</th>
                                                <th>Correo</th>
                                                <th>Acción</th>
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

                            <form  name='fe' action='?mod=registro&nuevo' method='post' id='ContactForm'>
                            <input title='Agregar nuevo proveedor' name='btn1'  class='btn btn-primary' type='submit' value='Agregar nuevo'>


                            </form>

    </div>  ";}?>
                        </br>

<?php
echo "

  <div class='col-xs-6' id='imprimir'>
  <div class='dataTables_paginate paging_bootstrap'>
                                 <a target='_blank'  href=./pdf/listaclientes.php><img src='./img/impresora.png'  width='50' alt='Edicion' title='Imprimir lista de proveedores'>
                                 </a>
                                </div>
                                </div>

                                "; ?>


<?php
}

if (isset($_GET['editar'])) {

//Codigo que viene de la lista
    $x1 = $_GET['codigo'];
    if (isset($_POST['editar'])) {

        $nombre            = strtoupper($_POST["nombre"]);
        $provincia         = strtoupper($_POST["provincia"]);
        $cp                = ($_POST["cp"]);
        $personal_contacto = strtoupper($_POST["personal_contacto"]);
        $movil             = ($_POST["movil"]);
        $poblacion         = strtoupper($_POST["poblacion"]);
        $correo            = strtoupper($_POST["correo"]);
        $ci                = strtoupper($_POST["ci"]);
        $direccion         = strtoupper($_POST["direccion"]);
        $telefono          = ($_POST["telefono"]);

        $sql = "SELECT * FROM `proveedores` WHERE cif='$ci'";

        if ($nombre == "") {

            echo "
   <script> alert('campos vacios')</script>
   ";
            echo "<br>";

        } else {
            $sql = "UPDATE proveedores SET
nombre='$nombre' ,
provincia='$provincia' ,
cp='$cp' ,
personal_contacto='$personal_contacto' ,
movil='$movil' ,
poblacion='$poblacion' ,
cif='$ci' ,
telefono='$telefono' ,
direccion='$direccion' ,
correo='$correo'
WHERE id_proveedores='$x1'";

            $bd->consulta($sql);

            //echo "Datos Guardados Correctamente";
            echo '<div class="alert alert-success alert-dismissable">
                                        <i class="fa fa-check"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <b>¡Los datos se han guardado correctamente!</b> ';
            echo '   </div>';

        }

    }

    $consulta = "SELECT cif, nombre, provincia, personal_contacto, cp, movil, poblacion, correo, telefono, direccion FROM proveedores WHERE id_proveedores='$x1'";
    $bd->consulta($consulta);
    while ($fila = $bd->mostrar_registros()) {

        ?>
  <div class="col-md-5">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Editar proveedores</h3>
                                </div>

        <?php echo '  <form role="form"  name="fe" action="?mod=registro&editar=editar&codigo=' . $x1 . '" method="post">';
        ?>
                                    <div class="box-body">
                                        <div class="form-group">

                                            <label for="exampleInputFile">Nombre</label>
                                            <input onkeypress="return caracteres(event)" onblur="this.value=this.value.toUpperCase();" type="text" required type="text" name="nombre" class="form-control" value="<?php echo $fila['nombre']; ?>" id="exampleInputEmail1" placeholder="Intoducir el Nombre">

                                            <label for="exampleInputFile">CIF</label>
                                            <input onkeypress="return caracteres(event)" required type="text" name="ci" class="form-control" value="<?php echo $fila['cif']; ?>" id="exampleInputEmail1" placeholder="CIF">

                                            <label for="exampleInputFile">Persona de contacto</label>
                                            <input onkeypress="return caracteres(event)" onblur="this.value=this.value.toUpperCase();" type="text" required type="text" name="personal_contacto" class="form-control" value="<?php echo $fila['personal_contacto']; ?>" id="exampleInputEmail1" placeholder="Persona contacto">

                                            <label for="exampleInputFile">Población</label>
                                            <input onkeypress="return caracteres(event)" onblur="this.value=this.value.toUpperCase();" required type="text" name="poblacion" class="form-control" value="<?php echo $fila['poblacion']; ?>" id="exampleInputEmail1" placeholder="Poblacion">

                                            <label for="exampleInputFile">Provincia</label>
                                            <input onkeypress="return caracteres(event)" onblur="this.value=this.value.toUpperCase();" required type="text" name="provincia" class="form-control" value="<?php echo $fila['provincia']; ?>" id="exampleInputEmail1" placeholder="Provincia">

                                            <label for="exampleInputFile">Código postal</label>
                                            <input onkeypress="return caracteres(event)" required type="text" name="cp" class="form-control" value="<?php echo $fila['cp']; ?>" id="exampleInputEmail1" placeholder="Código postal">

                                            <label for="exampleInputFile">Dirección</label>
                                            <input onkeydown="return caracteres(event)" onblur="this.value=this.value.toUpperCase();" required type="text" name="direccion" class="form-control" value="<?php echo $fila['direccion']; ?>" id="exampleInputEmail1" placeholder="Dirección">

                                            <label for="exampleInputFile">Teléfono</label>
                                            <input onkeydown="return enteros(this, event)" required type="text" name="telefono" class="form-control" value="<?php echo $fila['telefono']; ?>" id="exampleInputEmail1" placeholder="Teléfono">

                                            <label for="exampleInputFile">Móvil</label>
                                            <input onkeydown="return enteros(this, event)" required type="text" name="movil" class="form-control" value="<?php echo $fila['movil']; ?>" id="exampleInputEmail1" placeholder="Móvil">

                                            <label for="exampleInputFile">Correo</label>
                                            <input required type="email" name="correo" class="form-control" value="<?php echo $fila['correo']; ?>"  placeholder="Correo">
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

        $nombre            = strtoupper($_POST["nombre"]);
        $provincia         = strtoupper($_POST["provincia"]);
        $cp                = ($_POST["cp"]);
        $personal_contacto = strtoupper($_POST["personal_contacto"]);
        $movil             = ($_POST["movil"]);
        $poblacion         = strtoupper($_POST["poblacion"]);
        $correo            = strtoupper($_POST["correo"]);
        $ci                = strtoupper($_POST["ci"]);
        $direccion         = strtoupper($_POST["direccion"]);
        $telefono          = ($_POST["telefono"]);

        if ($x1 == "") {

            echo "
   <script> alert('campos vacios')</script>
   ";
            echo "<br>";

        } else {

            $sql = "DELETE FROM proveedores WHERE id_proveedores='$x1' ";

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
                                            <form  name="fe" action="?mod=registro&lista=lista" method="post" id="ContactForm">
                 <input title="Regresar a lista" name="btn1"  class="btn btn-primary"type="submit" value="Regresar a lista">
                  </form>
                  </center>
                                                </div>
                                            </div>
                                            </div>  ';

        }

    }
    $consulta = "SELECT cif, nombre, provincia, cp, personal_contacto, movil, poblacion, correo, telefono, direccion FROM proveedores WHERE id_proveedores='$x1'";
    $bd->consulta($consulta);
    while ($fila = $bd->mostrar_registros()) {

        ?>
<center>
  <div class="col-md-5">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Eliminar proveedor</h3>
                                </div>

        <?php echo '  <form role="form"  name="fe" action="?mod=registro&eliminar&codigo=' . $x1 . '" method="post">';
        ?>
                            <div class="box-body">
                                <div class="form-group">
                            <div class="box-body">
                                <div class="form-group">
                                    <center>
                                      <table id="example1" class="table table-bordered table-striped">
                                            <tr>
                                              <td>
                                                <h3>CIF</h3>
                                              </td>
                                            <td>
                                                <?php echo $fila['cif']; ?>
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
                                                <h3>Provincia</h3>
                                              </td>
                                            <td>
                                                <?php echo $fila['provincia']; ?>
                                            </td>
                                            </tr>
                                            <tr>
                                              <td>
                                                <h3>Código Postal</h3>
                                              </td>
                                            <td>
                                                <?php echo $fila['cp']; ?>
                                            </td>
                                            </tr>
                                            <tr>
                                              <td>
                                                <h3>Personal de contacto</h3>
                                              </td>
                                            <td>
                                                <?php echo $fila['personal_contacto']; ?>
                                           </td>
                                           </tr>
                                           <tr>
                                              <td>
                                                <h3>Móvil</h3>
                                              </td>
                                            <td>
                                                <?php echo $fila['movil']; ?>
                                            </td>
                                            </tr>
                                            <tr>
                                              <td>
                                                <h3>Población</h3>
                                              </td>
                                            <td>
                                                <?php echo $fila['poblacion']; ?>
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
                                            <tr>
                                              <td>
                                                <h3>Teléfono</h3>
                                              </td>
                                            <td>
                                                <?php echo $fila['telefono']; ?>
                                            </td>
                                            </tr>
                                            <tr>
                                              <td>
                                                <h3>Dirección</h3>
                                              </td>
                                            <td>
                                                <?php echo $fila['direccion']; ?>
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
                            <form  name="fe" action="?mod=registro&lista=lista" method="post" id="ContactForm">



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

    $consulta = "SELECT cif, nombre, provincia, cp, personal_contacto, movil, poblacion, correo, telefono, direccion FROM proveedores where id_proveedores='$x1'";
    $bd->consulta($consulta);
    while ($fila = $bd->mostrar_registros()) {

        ?>
<center>
  <div class="col-md-5">
                            <!-- general form elements -->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Consulta de proveedores</h3>
                                </div>

        <?php echo '  <form role="form"  name="fe" action="?mod=registro&consultar&codigo=' . $x1 . '" method="post">';
        ?>
                            <div class="box-body">
                                <div class="form-group">
                                    <center>
                                      <table id="example1" class="table table-bordered table-striped">
                                            <tr>
                                              <td>
                                                <h3>CIF</h3>
                                              </td>
                                            <td>
                                                <?php echo $fila['cif']; ?>
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
                                                <h3>Provincia</h3>
                                              </td>
                                            <td>
                                                <?php echo $fila['provincia']; ?>
                                            </td>
                                            </tr>
                                            <tr>
                                              <td>
                                                <h3>Código Postal</h3>
                                              </td>
                                            <td>
                                                <?php echo $fila['cp']; ?>
                                            </td>
                                            </tr>
                                            <tr>
                                              <td>
                                                <h3>Personal de contacto</h3>
                                              </td>
                                            <td>
                                                <?php echo $fila['personal_contacto']; ?>
                                           </td>
                                           </tr>
                                           <tr>
                                              <td>
                                                <h3>Móvil</h3>
                                              </td>
                                            <td>
                                                <?php echo $fila['movil']; ?>
                                            </td>
                                            </tr>
                                            <tr>
                                              <td>
                                                <h3>Población</h3>
                                              </td>
                                            <td>
                                                <?php echo $fila['poblacion']; ?>
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
                                            <tr>
                                              <td>
                                                <h3>Teléfono</h3>
                                              </td>
                                            <td>
                                                <?php echo $fila['telefono']; ?>
                                            </td>
                                            </tr>
                                            <tr>
                                              <td>
                                                <h3>Dirección</h3>
                                              </td>
                                            <td>
                                                <?php echo $fila['direccion']; ?>
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
                            <form  name="fe" action="?mod=registro&lista=lista" method="post" id="ContactForm">
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
</center>
</div>
<?php
include 'main_footer.php';
?>

