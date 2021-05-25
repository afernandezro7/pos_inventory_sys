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

                    <form role="form" id="form_sell" method="post">
                        <div class="box-body">
                            <div class="box" style="box-shadow: none;">
                                <!-- Vendor input      -->
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <input class="form-control" type="text" value="<?=$_SESSION['user']['name']?>" name="vendor" readonly required>
                                    </div>
                                </div>

                                <!-- sell_code input      -->
                                <div class="form-group">
                                    <?php 
                                        $sell_code= SellsController::getSellcode()
                                    ?>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                        <input class="form-control" type="text" value="<?=$sell_code?>" name="newSellCode" readonly required>
                                    </div>
                                </div>

                                <!-- client input      -->
                                <div class="form-group">
                                    <?php 
                                        $clients = ClientsController::ctrListClients()
                                    ?>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-users"></i></span>
                                        <select class="form-control" id="selectClient" name="selectClient" placeholder="Agregar Cliente" required>
                                            <option value="" disabled selected>Seleccionar Cliente</option>
                                            <?php foreach ($clients as $key => $client) : ?>
                                                <option value="<?=$client['id']?>"><?=$client['name']?></option>
                                            <?php endforeach; ?>
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

                                <!-- add product input  sells.js    -->
                                <div class="form-group newProduct" style="padding-bottom:5px">
                                    <!-- product description -->
                                    <!-- product amount -->
                                    <!-- price -->                                   
                                </div>

                                <!-- add product button  -->
                                <button type="button" class="btn btn-default hidden-lg add_product_mobile">Agregar Producto</button>                               
                                
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
                                                                value="0"  
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
                        <table class="table table-bordered table-striped dt-responsive customTables sellTable" width="100%">
                            <thead>
                                <tr>
                                    <th class="table-width_sm">#</th>
                                    <th>Imagen</th>
                                    <th>Código</th>
                                    <th>Descripción</th>
                                    <th>Stock</th>
                                    <th>Precio</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $products = ProductsController::ctrListProducts();
                                ?>
                                <?php foreach ($products as $key => $product) : ?>
                                    <?php if ($product['stock'] > 0) : ?>
                                        <tr>
                                            <td><?=$key+1?></td>
                                            <td class="table-width_sm text-center">
                                                <?php if (!empty($product['image'])) : ?>
                                                    <img class="img-thumbnail" width="40px" src="<?=$product['image']?>">
                                                <?php else: ?>
                                                    <img class="img-thumbnail" width="40px" src="views/img/products/default/anonymous.png">
                                                <?php endif; ?>
                                            </td>
                                            <td><?=$product['barcode']?></td>
                                            <td><?=$product['description']?></td>
                                            <td class="text-center">
                                                <?php if ($product['stock'] > 20) : ?>
                                                    <button class="btn btn-success"><?=$product['stock']?></button>
                                                <?php elseif ($product['stock'] >= 10): ?>
                                                    <button class="btn btn-warning"><?=$product['stock']?></button>
                                                <?php else: ?>
                                                    <button class="btn btn-danger"><?=$product['stock']?></button>
                                                <?php endif; ?>
                                            </td>
                                            <td class="text-right">$ <?=$product['sell_price']?></td>  
                                            <td>
                                                <div class="btn-group">
                                                    <button 
                                                        class="btn btn-primary add_product_to_sell_action rescue_btn" 
                                                        type="button"
                                                        idProduct="<?=$product['id']?>"
                                                    >Agregar</button>
                                                </div>
                                            </td>                   
                                        </tr>
                                    <?php endif; ?>
                                <?php endforeach; ?>
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