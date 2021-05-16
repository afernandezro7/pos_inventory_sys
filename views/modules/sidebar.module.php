<?php 
    $route = $_GET['ruta'];
?>
<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?=$avatar?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?=$name?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- sidebar menu -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="<?=($route=="inicio") ? 'active' : ''?>">
                <a href="inicio">
                    <i class="fa fa-home"></i>
                    <span>Inicio</span>
                </a>
            </li>
            <li class="<?=($route=="usuarios") ? 'active' : ''?>">
                <a href="usuarios">
                    <i class="fa fa-user"></i>
                    <span>Usuarios</span>
                </a>
            </li>
            <li class="<?=($route=="categorias") ? 'active' : ''?>">
                <a href="categorias">
                    <i class="fa fa-th"></i>
                    <span>Categorías</span>
                </a>
            </li>
            <li class="<?=($route=="productos") ? 'active' : ''?>">
                <a href="productos">
                    <i class="fa fa-product-hunt"></i>
                    <span>Productos</span>
                </a>
            </li>
            <li class="<?=($route=="clientes") ? 'active' : ''?>">
                <a href="clientes">
                    <i class="fa fa-users"></i>
                    <span>Clientes</span>
                </a>
            </li>
            <li class="treeview <?=($route=="ventas" || $route=="crear-venta" || $route=="reportes") ? 'active' : ''?>">
                <a href="">
                    <i class="fa fa-list-ul"></i>
                    <span>Ventas</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="<?=($route=="ventas") ? 'active' : ''?>">
                        <a href="ventas">
                            <i class="fa fa-circle-o"></i>
                            <span>Administrar Ventas</span>
                        </a>
                    </li>
                    <li class="<?=($route=="crear-venta") ? 'active' : ''?>">
                        <a href="crear-venta">
                            <i class="fa fa-circle-o"></i>
                            <span>Crear Venta</span>
                        </a>
                    </li>
                    <li class="<?=($route=="reportes") ? 'active' : ''?>">
                        <a href="reportes">
                            <i class="fa fa-circle-o"></i>
                            <span>Reporte de Ventas</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>


    </section>

</aside>