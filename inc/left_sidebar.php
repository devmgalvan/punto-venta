<!DOCTYPE html>
<html class="lockscreen">
    <head>
        <meta charset="UTF-8">
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    </head>
<div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="img/avatar3.png" class="img-circle" alt="User Image" />
                        </div>
                        <div class="pull-left info">
                            <p>Hola, <?php echo $_SESSION['dondequeda_nombre']; ?></p>

                            <a href="#"><i class="fa fa-circle text-success"></i>Conectado</a>
                        </div>
                    </div>
                    <!-- search form
                    <form action="#" method="get" class="sidebar-form">
                        <div class="input-group">
                            <input type="text" name="q" class="form-control" placeholder="Buscar..."/>
                            <span class="input-group-btn">
                                <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </form>-->
                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li class="active">
                            <a href="?mod=index" data-ajax="false">
                                <i class="glyphicon glyphicon-home"></i><span> Inicio</span>
                            </a>
                        </li>


                            <li class="treeview">
                                <a href="#">
                                    <i class="fa fa-group"></i>
                                    <span>Proveedores</span>
                                    <i class="  fa fa-unsorted"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <?php

if ($tipo2 == 1 || $tipo2 == 2) {?>
                                <li><a href="?mod=registro&nuevo"><i class="glyphicon glyphicon-floppy-open"></i>Registrar proveedor</a> </li>
                        <?php }?>
                                    <li><a href="?mod=registro&lista=lista"><i class="glyphicon glyphicon-list"></i>Lista de proveedores</a> </li>

                                    <li><a href="?mod=listaproveedores&proveedores"><i class="glyphicon glyphicon-tasks"></i>Id proveedores</a></li>
                                </ul>
                            </li>
                               <li class="treeview">
                                <a href="#">
                                    <i class="glyphicon glyphicon-phone"></i>
                                    <span>Productos</span>
                                    <i class="fa  fa fa-unsorted "></i>
                                </a>
                                <ul class="treeview-menu">
                                <?php

if ($tipo2 == 1 || $tipo2 == 2) {?>
                              <li><a href="?mod=registroproductos&nuevo"><i class="glyphicon glyphicon-floppy-open"></i>Registrar producto</a> </li>
                        <?php }?>

                                    <li><a href="?mod=registroproductos&lista"><i class="glyphicon glyphicon-list"></i>Lista de productos</a> </li>

                                    <li><a href="?mod=listarcategoriasyproductos&listar"><i class="glyphicon glyphicon-tasks"></i>Listar productos-categoria</a></li>

                                    <li><a href="?mod=listarproveedoresyproductos&listar"><i class="glyphicon glyphicon-tasks"></i>Listar productos-proveedor</a> </li>

                                    <!--<li><a href="cart/index.php"><i class="glyphicon glyphicon-shopping-cart"></i>Carrito</a></li>-->

<?php

if ($tipo2 == 1 || $tipo2 == 2) {?>
                                    <!--<li><a href="?mod=registrocategorias&nuevo"><i class="glyphicon glyphicon-floppy-open"></i>Registrar categoría</a></li>-->



                                    <!--<li><a href="?mod=registrocategorias&lista"><i class="glyphicon glyphicon-list"></i>Lista de categorías</a></li>-->
                                   <?php }?>
                                </ul>
                            </li>

                            <li class="treeview">
                                <a href="#">
                                    <i class="glyphicon glyphicon-inbox"></i>
                                    <span>Categorías</span>
                                    <i class="fa  fa fa-unsorted"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <?php
if ($tipo2 == 1 || $tipo2 == 2) {?>
                                    <li><a href="?mod=registrocategorias&nuevo"><i class="glyphicon glyphicon-floppy-open"></i>Registrar categoría</a></li>

                                    <li><a href="?mod=registrocategorias&lista"><i class="glyphicon glyphicon-list"></i>Lista de categorías</a></li>

                                    <!--<li><a href="#"><i class="glyphicon glyphicon-th-list"></i>LDPYC</a></li>-->
                                <?php }?>
                            </ul>
                        </li>

                             <li class="treeview">
                                <a href="#">
                                    <i class="glyphicon glyphicon-wrench"></i>
                                    <span>Devoluciones</span>
                                    <i class="fa  fa fa-unsorted "></i>
                                </a>
                                <ul class="treeview-menu">
                                <?php

if ($tipo2 == 1 || $tipo2 == 2) {?>
                              <li><a href="?mod=registrotaller&cargos"><i class=" glyphicon glyphicon-floppy-open"></i>Producto a devolver</a> </li>
                        <?php }?>

                                    <li><a href="?mod=registrotaller&listataller"><i class=" glyphicon glyphicon-list"></i>Productos en devolución</a> </li>

<?php

if ($tipo2 == 1 || $tipo2 == 2) {?>


                                    <!--<li><a href="?mod=registrotaller&listataller"><i class="glyphicon glyphicon-usd"></i>Entrega o devolución</a> </li>-->
                                   <?php }?>
                                </ul>
                            </li>




                         <li class="treeview">
                                <a href="#">
                                    <i class="glyphicon glyphicon-calendar"></i>
                                    <span>Almacén</span>
                                    <i class="fa  fa fa-unsorted "></i>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="?mod=registrokardex&diario"><i class=" fa fa-sort-amount-desc"></i>Inventario diario</a> </li>
                                    <li><a href="?mod=registrokardex&semanal"><i class="  fa fa-sort-amount-desc"></i>Inventario semanal</a> </li>
                                     <li><a href="?mod=registrokardex&mensual"><i class="  fa fa-sort-amount-desc"></i>Inventario mensual</a> </li>
                                      <li><a href="?mod=registrokardex&total"><i class=" fa fa-sort-amount-desc"></i>Inventario completo </a> </li>



                                </ul>
                            </li>

                        <?php

if ($tipo2 == 1) {
    ?>



<?php
if ($tipo2 == 1) {

        ?>
                            <li class="treeview">
                                <a href="#">
                                    <i class="fa fa-gears"></i>
                                    <span>Administración</span>
                                    <i class="fa  fa fa-unsorted"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="?mod=registroadmin&nuevo"><i class="glyphicon glyphicon-user"></i>Registrar usuario</a> </li>
                                    <li><a href="?mod=registroadmin&lista=lista"><i class="glyphicon glyphicon-list-alt"></i>Lista de usuarios</a> </li>

                                    <!--<li><a href="?mod=registroadmin&lista=lista"><i class=" glyphicon glyphicon-wrench"></i>Opciones</a> </li>-->
                                    <!--<li><a href="?mod=/respaldo/respaldo&respaldo=respaldo"><i class=" glyphicon glyphicon-hdd"></i>Respaldar BD</a> </li>-->
                                   <!--          ?mod=/respaldo/respaldo&respaldo=respaldo-->

                                </ul>
                            </li>




                        <?php

    }
}?>

                </section>
                <!-- /.sidebar -->
            </aside>
        </html>