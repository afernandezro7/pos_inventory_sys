<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Administrar Clientes
        </h1>
        <ol class="breadcrumb">
            <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active">Clientes</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">

            <div class="box-header with-border">

                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAddClient">
                    Agregar Cliente
                </button>

            </div>

            <div class="box-body">      
                <table class="table table-bordered table-striped dt-responsive customTables" width="100%">
                    <thead>
                        <tr>
                            <th class="table-width_sm">#</th>
                            <th>Nombre</th>
                            <th>Cédula</th>
                            <th>Email</th>
                            <th>Teléfono</th>
                            <th>Dirección</th>
                            <th>Fecha de Nacimiento</th>
                            <th>Total de compras</th>
                            <th>Última compra</th>
                            <th>Ingreso al sistema</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $clients = ClientsController::ctrListClients();
                        ?>
                        <?php foreach ($clients as $key => $client) : ?>
                            <tr>
                                <td class="table-width_sm"><?=$key+1?></td>
                                <td><?=$client['name']?></td>
                                <td><?=$client['identity']?></td>
                                <td><?=$client['email']?></td>
                                <td><?=$client['phone']?></td>
                                <td><?=$client['address']?></td>
                                <td><?=$client['birth']?></td>
                                <td class="text-center">
                                    <?php if ($client['purchases'] >= 5): ?>
                                        <button class="btn btn-primary"><?=$client['purchases']?></button>
                                    <?php else: ?>
                                        <button class="btn btn-secundary"><?=$client['purchases']?></button>
                                    <?php endif; ?>
                                </td>
                                <td><?=Helpers::LongTimeFilter($client['last_purchase'])?></td>
                                <td><?=$client['createdAt']?></td>
                                <td>
                                    <div class="btn-group">
                                        <button 
                                            class="btn btn-warning btnEditClient" 
                                            data-toggle="modal" 
                                            data-target="#modalEditClient"
                                            idClient="<?=$client['id']?>"
                                        ><i class="fa fa-pencil"></i></button>
                                        <button 
                                            class="btn btn-danger btn_delete_client" 
                                            idClient="<?=$client['id']?>"
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
=               MODAL CREATE Client              =
============================================= -->
<div class="modal fade" id="modalAddClient" role="dialog">
    <div class="modal-dialog">

        <div class="modal-content">
            <form role="form" method="POST" enctype="multipart/form-data">

                <div class="modal-header" style="background:#3c8dbc; color:white">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">Agregar Cliente</h4>
                </div>

                <div class="modal-body">
                    <div class="box-body">
                        <!-- name input  -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input class="form-control " type="text" name="newClientName" placeholder="Ingresar Nombre" required>
                            </div>
                        </div>

                        <!-- identity input  -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-code"></i></span>
                                <input class="form-control " type="text" name="newClientIdentity" placeholder="Ingresar Cédula" >
                            </div>
                        </div>

                        <!-- email input  -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                <input class="form-control " type="email" name="newClientEmail" placeholder="Ingresar Email" >
                            </div>
                        </div>

                        <!-- phone input  -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                <input 
                                    class="form-control" 
                                    type="text" 
                                    name="newClientPhone" 
                                    placeholder="Ingresar Teléfono"
                                    data-inputmask="'mask':'(+999) 99999999'" 
                                    data-mask
                                >
                            </div>
                        </div>

                        <!-- address input  -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                <input class="form-control " type="text" name="newClientAddress" placeholder="Ingresar Dirección" >
                            </div>
                        </div>

                        <!-- date of birth input  -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa  fa-calendar"></i></span>
                                <input 
                                    class="form-control" 
                                    type="text" 
                                    name="newClientBirthDate" 
                                    placeholder="Ingresar Fecha de Nacimiento"
                                    data-inputmask="'alias':'yyyy/mm/dd'" 
                                    data-mask
                                >
                            </div>
                        </div>
                        
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
                    <button type="submit" class="btn btn-primary">Guardar Cliente</button>
                </div>

                <?php
                    ClientsController::ctrAddClient();
                ?>

            </form>

        </div>
    </div>
</div>

<!-- =============================================
=               MODAL EDIT Client               =
============================================= -->
<div class="modal fade" id="modalEditClient" role="dialog">
    <div class="modal-dialog">

        <div class="modal-content">
            <form role="form" method="POST" enctype="multipart/form-data">

                <div class="modal-header" style="background:#3c8dbc; color:white">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">Editar Cliente</h4>
                </div>

                <div class="modal-body">
                    <div class="box-body">
                        <!-- id hidden input  -->
                        <input type="hidden" name="editClientId" id="editClientId">

                        <!-- name input  -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input class="form-control " type="text" id="editClientName" name="editClientName" placeholder="Ingresar Nombre" required>
                            </div>
                        </div>

                        <!-- identity input  -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-code"></i></span>
                                <input class="form-control " type="text" id="editClientIdentity" name="editClientIdentity" placeholder="Ingresar Cédula" >
                            </div>
                        </div>

                        <!-- email input  -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                <input class="form-control " type="email" id="editClientEmail" name="editClientEmail" placeholder="Ingresar Email" >
                            </div>
                        </div>

                        <!-- phone input  -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                <input 
                                    class="form-control" 
                                    type="text" 
                                    id="editClientPhone" 
                                    name="editClientPhone" 
                                    placeholder="Ingresar Teléfono"
                                    data-inputmask="'mask':'(+999) 99999999'" 
                                    data-mask
                                >
                            </div>
                        </div>

                        <!-- address input  -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                <input class="form-control " type="text" id="editClientAddress" name="editClientAddress" placeholder="Ingresar Dirección" >
                            </div>
                        </div>

                        <!-- date of birth input  -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa  fa-calendar"></i></span>
                                <input 
                                    class="form-control" 
                                    type="text" 
                                    id="editClientBirthDate" 
                                    name="editClientBirthDate" 
                                    placeholder="Ingresar Fecha de Nacimiento"
                                    data-inputmask="'alias':'yyyy/mm/dd'" 
                                    data-mask
                                >
                            </div>
                        </div>
                        
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
                    <button type="submit" class="btn btn-primary">Guardar Cliente</button>
                </div>

                <?php
                    ClientsController::ctrEditClient();
                ?>

            </form>

        </div>
    </div>
</div>