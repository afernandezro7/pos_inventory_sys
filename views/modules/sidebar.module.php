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
            <li class="active">
                <a href="inicio">
                    <i class="fa fa-home"></i>
                    <span>Inicio</span>
                </a>
            </li>
            <li>
                <a href="usuarios">
                    <i class="fa fa-user"></i>
                    <span>Usuarios</span>
                </a>
            </li>
            <li>
                <a href="categorias">
                    <i class="fa fa-th"></i>
                    <span>Categorías</span>
                </a>
            </li>
            <li>
                <a href="productos">
                    <i class="fa fa-product-hunt"></i>
                    <span>Productos</span>
                </a>
            </li>
            <li>
                <a href="clientes">
                    <i class="fa fa-users"></i>
                    <span>Clientes</span>
                </a>
            </li>
            <li class="treeview">
                <a href="">
                    <i class="fa fa-list-ul"></i>
                    <span>Ventas</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="ventas">
                            <i class="fa fa-circle-o"></i>
                            <span>Administrar Ventas</span>
                        </a>
                    </li>
                    <li>
                        <a href="crear-venta">
                            <i class="fa fa-circle-o"></i>
                            <span>Crear Venta</span>
                        </a>
                    </li>
                    <li>
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