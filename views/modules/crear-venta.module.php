<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Crear Venta
        </h1>
        <ol class="breadcrumb">
            <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active">Crear Venta</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">

            <!-- FORM  -->
            <div class="col-lg-5 col-xs-12">
                <div class="box box-success">

                    <div class="box-header with-border"></div>

                    <form role="form" method="post">
                        <div class="box-body">
                            <div class="box" style="box-shadow: none;">
                                <!-- Vendor input      -->
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <input class="form-control" type="text" value="<?=$_SESSION['user']['name']?>" name="vendor" readonly required>
                                    </div>
                                </div>

                                <!-- sellcode input      -->
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                        <input class="form-control" type="text" value="1234242" name="newSellCode" readonly required>
                                    </div>
                                </div>

                                <!-- client input      -->
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-users"></i></span>
                                        <select class="form-control" id="selectClient" name="selectClient" placeholder="Agregar Cliente" required>
                                            <option value="" disabled selected>Seleccionar Cliente</option>
                                        </select>
                                        <span class="input-group-addon" style="padding:3px">
                                            <button 
                                                class="btn btn-default btn-xs" 
                                                type="button" 
                                                data-toggle="modal"
                                                data-target="#modalAddClient"
                                                data-dismiss="modal"
                                            >Agregar Cliente</button>
                                        </span>
                                    </div>
                                </div>

                                <!-- add product input      -->
                                <div class="form-group row newProduct">
                                    <!-- product description -->
                                    <div class="col-xs-6" style="padding-right:0px">
                                        <div class="input-group">
                                            <span class="input-group-addon" style="padding:3px">
                                                <button class="btn btn-danger btn-xs" type="button">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                            </span>
                                            <input 
                                                class="form-control" 
                                                type="text" 
                                                id="addProduct"  
                                                name="addProduct" 
                                                placeholder="Descripción del Producto"  
                                                required
                                            >
                                        </div>
                                    </div>

                                    <!-- product amount -->
                                    <div class="col-xs-3">
                                        <input 
                                            class="form-control" 
                                            type="number" 
                                            id="newAmountProduct"  
                                            name="newAmountProduct"
                                            min="1" 
                                            placeholder="Cant"  
                                            required
                                        >
                                    </div>

                                    <!-- price -->
                                    <div class="col-xs-3" style="padding-left:0px">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
                                            <input 
                                                class="form-control" 
                                                type="number" 
                                                id="newPriceProduct"  
                                                name="newPriceProduct"
                                                min="1" 
                                                step="any"
                                                placeholder="000"  
                                                required
                                            >
                                        </div>
                                    </div>
                                </div>

                                <!-- add product button  -->
                                <button type="button" class="btn btn-default hidden-lg">Agregar Producto</button>                               
                                
                                <!-- tax and total  -->
                                <hr style="margin-bottom: 5px;">                              
                                <div class="row">
                                    <div class="col-xs-8 pull-right">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Impuesto</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td style="width:50%">
                                                        <div class="input-group">
                                                            
                                                            <input 
                                                                type="number" 
                                                                class="form-control" 
                                                                min="0"
                                                                id="newSellTax"  
                                                                name="newSellTax" 
                                                                placeholder="0"  
                                                                required
                                                            >
                                                            <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                                                        </div>
                                                    </td>
                                                    <td style="width:50%">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
                                                            <input 
                                                                type="number" 
                                                                class="form-control" 
                                                                min="1"
                                                                id="newTotalSell"  
                                                                name="newTotalSell" 
                                                                placeholder="0000"
                                                                readonly  
                                                                required
                                                            >
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <hr style="margin-top: 5px;">

                                <!-- payment method  -->
                                <div class="form-group row">
                                    <div class="col-xs-6" style="padding-right: 5px">
                                        <div class="input-group">
                                            <select class="form-control" id="newPaymentMethod" name="newPaymentMethod" required>
                                                <option value="" disabled selected>Método de pago</option>
                                                <option value="efectivo" >Efectivo</option>
                                                <option value="tc" >Tarjeta Crédito</option>
                                                <option value="td" >Tarjeta Débito</option>
                                            </select>
                                            <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
                                        </div>
                                    </div>
                                    <div class="col-xs-6" style="padding-left: 0px">
                                        <div class="input-group">
                                            <input 
                                                type="text"
                                                class="form-control"
                                                id="newTransactionCode"
                                                name="newTransactionCode"
                                                placeholder="Código Transacción"
                                                required
                                            >
                                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                        </div>
                                    </div>

                                </div>
                                
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary pull-right">Guardar Venta</button>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- PRODUCT TABLE  -->
            <div class="col-lg-7 hidden-md hidden-sm hidden-xs">
                <div class="box box-warning">

                    <div class="box-header with-border"></div>

                    <div class="box-body">
                        <table class="table table-bordered table-striped dt-responsive customTables">
                            <thead>
                                <tr>
                                    <th class="table-width_sm">#</th>
                                    <th>Código</th>
                                    <th>Descripción</th>
                                    <th>Categoría</th>
                                    <th>Stock</th>
                                    <th>Precio</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>I003-000001</td>
                                    <td>Huawei y9</td>
                                    <td>Celulares Huawei</td>
                                    <td class="text-center">17</td>
                                    <td>$ 180.00</td>
                                    <td>
                                        <div class="btn-group">
                                            <button class="btn btn-primary" type="button">Agregar</button>
                                        </div>
                                    </td>
                                    
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    
                </div>
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
            <form role="form" method="POST">

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