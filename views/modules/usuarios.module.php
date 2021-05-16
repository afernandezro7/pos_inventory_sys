<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Administrar Usuarios
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
                <table class="table table-bordered table-striped dt-responsive customTables" width="100%">
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
                        <?php
                            $users = UsersController::ctrUsersList();
                        ?>
                        <?php foreach ($users as $key => $user) : ?>
                            <tr>
                                <td><?=$key + 1?></td>
                                <th>
                                    <?php if (!empty($user['avatar'])) : ?>
                                        <img class="img-responsive" width="40px" src="<?=$user['avatar']?>">
                                    <?php else: ?>
                                        <img class="img-responsive" width="40px" src="views/img/users/default/anonymous.png">
                                    <?php endif; ?>
                                </th>
                                <td><?=$user['name']?></td>
                                <td><?=$user['userName']?></td>
                                <td><?=$user['role']?></td>
                                <td>
                                    <?php if ($user['status']==1) : ?>
                                        <button 
                                            class="btn btn-success btn-xs btn_activation"
                                            idUser="<?=$user['id']?>"
                                            toggleStatus="0"
                                        >Activado</button>
                                    <?php elseif($user['status']==0): ?>
                                        <button 
                                            class="btn btn-danger btn-xs btn_activation"
                                            idUser="<?=$user['id']?>"
                                            toggleStatus="1"
                                        >Desactivado</button>
                                    <?php endif; ?>
                                </td>
                                <td><?=Helpers::LongTimeFilter($user['lastLogin'])?></td>
                                <td>
                                    <div class="btn-group">
                                        <button 
                                            class="btn btn-warning btnEditUser" 
                                            data-toggle="modal" 
                                            data-target="#modalEditUser"
                                            idUser="<?=$user['id']?>"
                                        >
                                            <i class="fa fa-pencil"></i>
                                        </button>
                                        <button 
                                            class="btn btn-danger btn_delete_user" 
                                            idUser="<?=$user['id']?>"
                                        ><i class="fa fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                        
                        <?php endforeach; ?>
                        
                    </tbody>

                </table>
            </div>


        </div>
    </section>
</div>

<!-- =============================================
=               MODAL CREATE USER                =
============================================= -->
<div class="modal fade" id="modalAddUser" role="dialog">
    <div class="modal-dialog">

        <div class="modal-content">
            <form role="form" method="POST" enctype="multipart/form-data">

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
                                <input class="form-control " type="text" id="newUsername" name="userName" placeholder="Ingresar Usuario" required>
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
                                    <option value="Vendedor">Vendedor</option>
                                    <option value="Gestor">Gestor</option>
                                    <option value="Administrador">Administrador</option>
                                </select>
                            </div>
                        </div>
                        <!-- avatar input  -->
                        <div class="form-group">
                            <div class="panel">SUBIR FOTO</div>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-fw fa-file-image-o"></i></span>
                                <input class="form-control newAvatar" type="file" name="avatar">
                            </div>

                            <p class="help-block">Peso máximo 2 Mb</p>
                            <img class="img-thumbnail preview_image" width="100px" src="views/img/users/default/anonymous.png" alt="logo">
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
                    <button type="submit" class="btn btn-primary">Guardar Usuario</button>
                </div>

                <?php
                UsersController::ctrAddUser();
                ?>

            </form>

        </div>
    </div>
</div>


<!-- =============================================
=               MODAL EDIT USER                =
============================================= -->
<div class="modal fade" id="modalEditUser" role="dialog">
    <div class="modal-dialog">

        <div class="modal-content">
            <form role="form" method="POST" autocomplete="nope" enctype="multipart/form-data">

                <div class="modal-header" style="background:#3c8dbc; color:white">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">Editar Usuario</h4>
                </div>

                <div class="modal-body">
                    <div class="box-body">
                        <!-- name input  -->
                        <input type="hidden" name="editId" id="editId">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input class="form-control " type="text" name="editName" id="editName" required>
                            </div>
                        </div>
                        <!-- userName input  -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                <input class="form-control " type="text" name="editUserName" id="editUserName" required>
                            </div>
                        </div>
                        <!-- password input  -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                <input class="form-control " type="password" name="editPassword" placeholder="Escriba la nueva Contraseña" required >
                            </div>
                        </div>
                        <!-- role input  -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                                <select class="form-control" id="editRole"  name="editRole">
                                    <option value="" disabled>Seleccionar Role</option>
                                    <option value="Vendedor">Vendedor</option>
                                    <option value="Gestor">Gestor</option>
                                    <option value="Administrador">Administrador</option>
                                </select>
                            </div>
                        </div>
                        <!-- avatar input  -->
                        <div class="form-group">
                            <div class="panel">SUBIR FOTO</div>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-fw fa-file-image-o"></i></span>
                                <input class="form-control newAvatar" type="file" name="editAvatar">
                            </div>

                            <p class="help-block">Peso máximo 2 Mb</p>
                            <img class="img-thumbnail preview_image" width="100px" src="views/img/users/default/anonymous.png" alt="logo">
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
                    <button type="submit" class="btn btn-primary">Modificar Usuario</button>
                </div>

                <?php
                    UsersController::ctreditUser();
                ?>

            </form>

        </div>
    </div>
</div>
<!-- ============  End of MODAL  ============= -->

<!-- =============================================
=                  DELETE USER                   =
============================================= -->
<?php
    UsersController::ctrDeleteUser();
?>