<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Administrar Categorias
        </h1>
        <ol class="breadcrumb">
            <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active">Categorias</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">

            <div class="box-header with-border">

                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAddCategory">
                    Agregar Categoría
                </button>

            </div>

            <div class="box-body">      
                <table class="table table-bordered table-striped dt-responsive customTables" width="100%">
                    <thead>
                        <tr>
                            <th class="table-width_sm">#</th>
                            <th>Categorías</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="table-width_sm">1</td>
                            <td>Celulares</td>
                            <td>
                                <div class="btn-group">
                                    <button 
                                        class="btn btn-warning btnEditUser" 
                                        data-toggle="modal" 
                                        data-target="#modalEditUser"
                                        idCategory="1"
                                    ><i class="fa fa-pencil"></i></button>
                                    <button 
                                        class="btn btn-danger btn_delete_user" 
                                        idCategory="1"
                                    ><i class="fa fa-trash"></i></button>
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
=               MODAL CREATE USER                =
============================================= -->
<div class="modal fade" id="modalAddCategory" role="dialog">
    <div class="modal-dialog">

        <div class="modal-content">
            <form role="form" method="POST">

                <div class="modal-header" style="background:#3c8dbc; color:white">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">Agregar Categoría</h4>
                </div>

                <div class="modal-body">
                    <div class="box-body">
                        <!-- category name input  -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                                <input class="form-control " type="text" name="categoryName" placeholder="Ingresar nombre de la categoría" required>
                            </div>
                        </div>                      
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
                    <button type="submit" class="btn btn-primary">Guardar Categoría</button>
                </div>

                <?php
                    // UsersController::ctrAddUser();
                ?>

            </form>

        </div>
    </div>
</div>