<?php 
    if (Helpers::getPermission($_SESSION['user']['role'],["Administrador", "Gestor"]) == false){
        echo "<script>
					swal({
						type: 'error',
						title: 'No está autorizado a editar venta',
						showConfirmButton: true,
						confirmButtonText: 'cerrar',
						closeOnConfirm: false
			 		}).then((res)=>{
						if(res.value){
							window.location = 'ventas';
						}
					});
				</script>";
    }
?>


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Editar Venta
        </h1>
        <ol class="breadcrumb">
            <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active">Crear Venta</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <?php
                if(isset($_GET['idsellToedit']) && !empty($_GET['idsellToedit'])){
                    $sell = SellsController::getSellInfo($_GET['idsellToedit']);

                    var_dump($sell);
                    
                    if(!is_array($sell)){
                        echo "<script>
					            window.location = 'ventas';
						      </script>";
                    }
                }
                else {
                    echo "<script>
					            window.location = 'ventas';
						</script>";
                }
            ?>

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
                                        <select class="form-control" name="vendor" readonly required>
                                            <option value="<?=$sell['vendor_id']?>"><?=$sell['vendor']?></option>
                                        </select>
                                        
                                    </div>
                                </div>

                                <!-- sell_code input      -->
                                <div class="form-group">
                                    <?php 
                                        $sell_code= Helpers::sellCodeViewGenerator($sell['sell_code']);
                                    ?>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-key"></i></span>
                                        <input class="form-control" type="text" value="<?=$sell_code?>" name="editSellCode" readonly required>
                                    </div>
                                </div>

                                <!-- client input      -->
                                <div class="form-group">
                                    
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-users"></i></span>
                                        <select class="form-control" id="selectClient" name="selectClientSell" placeholder="Agregar Cliente" readonly required>
                                            <option value="<?=$sell['client_id']?>"><?=$sell['client']?></option>
                                        </select>
                                        <!-- <span class="input-group-addon" style="padding:3px">
                                            <button 
                                                class="btn btn-default btn-xs" 
                                                type="button" 
                                                data-toggle="modal"
                                                data-target="#modalAddClient"
                                                data-dismiss="modal"
                                            >Agregar Cliente</button>
                                        </span> -->
                                    </div>
                                </div>

                                <!-- add product input  sells.js    -->
                                
                                <div class="form-group newProduct" style="padding-bottom:5px">
                                    <?php foreach ($sell['items'] as $keyprod => $product) : ?>
                                        <div class="row" style="padding:5px 5px">
                                            <!-- product description -->
                                            <div class="col-xs-5" style="padding-right:0px">
                                                <div class="input-group">
                                                    <span class="input-group-addon" style="padding:3px">
                                                        <button 
                                                            class="btn btn-danger btn-xs quit_product_sell" 
                                                            idProduct="<?=$product['product_id']?>" 
                                                            type="button"
                                                        >
                                                            <i class="fa fa-times"></i>
                                                        </button>
                                                    </span>
                                                    <select 
                                                        class="form-control product_desc" 
                                                        idProduct="<?=$product['product_id']?>" 
                                                        name="addProductSell<?=$keyprod+1?>" 
                                                        readonly  
                                                        required
                                                    >
                                                        <option value="<?=$product['product_id']?>"><?=$product['description']?></option>
                                                    </select>
                                                </div>
                                            </div>
                                    
                                            <!-- product amount -->
                                            <div class="col-xs-3 productamount">
                                                <input  
                                                    class="form-control product_amount"
                                                    type="number"   
                                                    name="newAmountProduct<?=$keyprod+1?>"
                                                    min="1" 
                                                    value="<?=$product['units']?>" 
                                                    max="<?=intval($product['stock']) + intval($product['units'])?>"
                                                    stock="<?=intval($product['stock']) + intval($product['units'])?>?>"
                                                    required
                                                >
                                            </div>

                                            <!-- price -->  
                                            <input type="hidden" value="0" name="itemAmount" id="itemAmount"> 
                                            <div class="col-xs-4 productprice" style="padding-left:0px">
                                                <div class="input-group">


                                                    <span class="input-group-addon">
                                                      <input type="checkbox" class="price_checkbox" checkbox_target="<?=$product['product_id']?>">
                                                    </span>

                                                    <input 
                                                        checkbox_id="<?=$product['product_id']?>"
                                                        class="form-control product_price" 
                                                        type="number"
                                                        name="newPriceProduct<?=$keyprod+1?>"
                                                        min="<?=$product['cost']?>"
                                                        value="<?=$product['price']?>" 
                                                        stock="1"
                                                        total="<?=$product['price']?>"
                                                        step="any"
                                                        placeholder="000"  
                                                        readonly
                                                        required
                                                    >
                                                    <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
                                                </div>
                                            </div>                                

                                        </div>

                                        <?php endforeach; ?>
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
                                                                step="any"
                                                                id="newSellTax"  
                                                                name="newSellTax" 
                                                                value="<?=$sell['taxes']?>"  
                                                                required
                                                            >
                                                            <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                                                        </div>
                                                    </td>
                                                    <td style="width:50%">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
                                                            <input 
                                                                type="text" 
                                                                class="form-control"
                                                                id="newTotalSell"  
                                                                name="newTotalSell"
                                                                value="<?=$sell['total_price']?>" 
                                                                placeholder="0000"
                                                                readonly  
                                                                required
                                                            >
                                                            <input type="hidden" name="newNetTotalSell" value="<?=$sell['net_price']?>"  id="newNetTotalSell">
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <hr style="margin-top: 5px;">

                                <!-- payment method  -->
                                <?php
                                    $payment = Helpers::getPayment($sell['payment_method']);
                                ?>
                                <div class="form-group row">
                                    <div class="col-xs-<?=$payment['method'] == "efectivo" ? "4" : "6"?>" style="padding-right: 5px">
                                        <div class="input-group">
                                            <select class="form-control" id="newPaymentMethod" name="newPaymentMethod" required>
                                                <option value="efectivo" <?=$payment['method'] == "efectivo" ? "selected" :""?>>Efectivo</option>
                                                <option value="TC" <?=$payment['method'] == "TC" ? "selected" :""?>>Tarjeta Crédito</option>
                                                <option value="TD" <?=$payment['method'] == "TD" ? "selected" :""?>>Tarjeta Débito</option>
                                            </select>
                                            <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
                                        </div>
                                    </div>
                                    <?php if ($payment['method'] != "efectivo"):?>                                   
                                        <div class="col-xs-6 newTransactionCode" style="padding-left: 0px">
                                            <div class="input-group">
                                                <input 
                                                    type="text"
                                                    class="form-control"
                                                    id="newTransactionCode"
                                                    name="newTransactionCode"
                                                    placeholder="Código Transacción"
                                                    value="<?=$payment['code']?>"
                                                >
                                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                            </div>
                                        </div>
                                    <?php else:?>
                                        <div class="col-xs-4 deliveredcash" style="padding-left: 0px">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
                                                <input 
                                                    type="text"
                                                    class="form-control"
                                                    id="delivered_cash"
                                                    step="any"
                                                    name="delivered_cash"
                                                    placeholder="Entregado"

                                                >
                                            </div>
                                        </div>
                                        <div class="col-xs-4 changecash" style="padding-left: 0px">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
                                                <input 
                                                    type="text"
                                                    class="form-control"
                                                    id="change_cash"
                                                    name="change_cash"
                                                    placeholder="Devolver"

                                                >
                                            </div>
                                        </div>
                                    <?php endif;?>

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

            <?php
                SellsController::ctrAddSell();
            ?>

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