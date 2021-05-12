<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Usuarios
            <small>Panel de Control</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active">Usuarios</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">

            <div class="box-header with-border">

                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAddUser">
                    Agregar Usuario
                </button>

            </div>

            <div class="box-body">
                <table class="table table-bordered table-striped dt-responsive customTables">
                    <thead>
                        <tr>
                            <th class="table-width_sm">#</th>
                            <th class="table-width_sm">foto</th>
                            <th>Nombre</th>
                            <th>Usuario</th>
                            <th>Role</th>
                            <th>Estado</th>
                            <th>Último Login</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <th>
                                <img class="img-responsive" width="40px" src="views/dist/img/avatar.png">
                            </th>
                            <td>Ariel Sanchez</td>
                            <td>Arielsg3</td>
                            <td>Administrador</td>
                            <td><button class="btn btn-success btn-xs">Activado</button></td>
                            <td>Hace 2 días</td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-warning"><i class="fa fa-pencil"></i></button>
                                    <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <th>
                                <img class="img-responsive" width="40px" src="views/dist/img/avatar2.png">
                            </th>
                            <td>Ani Sanchez</td>
                            <td>Anisg3</td>
                            <td>ROLE_ADMIN</td>
                            <td><button class="btn btn-danger btn-xs">Desactivado</button></td>
                            <td>Hace 1 días</td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-warning "><i class="fa fa-pencil"></i></button>
                                    <button class="btn btn-danger "><i class="fa fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                    </tbody>

                </table>
            </div>


        </div>
    </section>
</div>

<!-- =============================================
=                   MODAL                   =
============================================= -->
<div class="modal fade" id="modalAddUser" role="dialog">
    <div class="modal-dialog">

        <div class="modal-content">
            <form role="form" method="post" enctype="multipart/form-data">

                <div class="modal-header" style="background:#3c8dbc; color:white">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">Agregar Usuario</h4>
                </div>
    
                <div class="modal-body">
                    <div class="box-body">
                        <!-- name input  -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input class="form-control " type="text" name="name" placeholder="Ingresar Nombre" required>
                            </div>
                        </div>
                        <!-- userName input  -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                <input class="form-control " type="text" name="userName" placeholder="Ingresar Usuario" required>
                            </div>
                        </div>
                        <!-- password input  -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                <input class="form-control " type="password" name="password" placeholder="Ingresar Contraseña" required>
                            </div>
                        </div>
                        <!-- role input  -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                                <select class="form-control " name="role">
                                    <option value="" disabled>Seleccionar Role</option>
                                    <option value="ROLE_VENDOR">Vendedor</option>
                                    <option value="ROLE_MANAGER">Gestor</option>
                                    <option value="ROLE_ADMIN">Administrador</option>
                                </select>
                            </div>
                        </div>
                        <!-- avatar input  -->
                        <div class="form-group">
                            <div class="panel">SUBIR FOTO</div>
                            <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-fw fa-file-image-o"></i></span>
                                <input class="form-control " type="file" id="newAvatar" name="avatar">
                            </div>
                           
                            <p class="help-block">Peso máximo 200 Mb</p>
                            <img class="img-thumbnail" width="100px" src="views/img/users/default/anonymous.png" alt="logo">
                        </div>
                    </div>
                </div>
    
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
                    <button type="button" type="submit" class="btn btn-primary">Guardar Usuario</button>
                </div>

                <?php
                    UsersController::ctrAddUser();
                ?>

            </form>

        </div>
    </div>
</div>


<!-- ============  End of MODAL  ============= -->