<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Administrar Productos
        </h1>
        <ol class="breadcrumb">
            <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active">Productos</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">

            <div class="box-header with-border">

                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAddProduct">
                    Agregar Productos
                </button>

            </div>

            <div class="box-body">      
                <table class="table table-bordered table-striped dt-responsive customTables" width="100%">
                    <thead>
                        <tr>
                            <th class="table-width_sm">#</th>
                            <th class="table-width_sm">Imagen</th>
                            <th>Código</th>
                            <th>Descripción</th>
                            <th>Categoría</th>
                            <th>Stock</th>
                            <th>Costo</th>
                            <th>Precio de venta</th>
                            <th>Agregado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $products = ProductsController::ctrListProducts();
                        ?>
                        <?php foreach ($products as $key => $product) : ?>
                            <tr>
                                <td class="table-width_sm"><?=$key+1?></td>               
                                <td class="table-width_sm text-center">
                                    <?php if (!empty($product['image'])) : ?>
                                        <img class="img-thumbnail" width="40px" src="<?=$product['image']?>">
                                    <?php else: ?>
                                        <img class="img-thumbnail" width="40px" src="views/img/products/default/anonymous.png">
                                    <?php endif; ?>
                                </td>   
                                <td><?=$product['barcode']?></td>                        
                                <td><?=$product['description']?></td>                        
                                <td class="text-uppercase"><?=$product['category']?></td>                        
                                <td class="text-center">
                                    <?php if ($product['stock'] > 20) : ?>
                                        <button class="btn btn-success"><?=$product['stock']?></button>
                                    <?php elseif ($product['stock'] >= 10): ?>
                                        <button class="btn btn-warning"><?=$product['stock']?></button>
                                    <?php else: ?>
                                        <button class="btn btn-danger"><?=$product['stock']?></button>
                                    <?php endif; ?>
                                </td>                        
                                <td class="text-right">$ <?=$product['cost']?></td>                        
                                <td class="text-right">$ <?=$product['sell_price']?></td>                        
                                <td><?=Helpers::LongTimeFilter($product['createdAt'])?></td>                        
                                <td>
                                    <div class="btn-group">
                                        <button 
                                            class="btn btn-warning btnEditProduct" 
                                            data-toggle="modal" 
                                            data-target="#modalEditProduct"
                                            idProduct="<?=$product['id']?>"
                                        ><i class="fa fa-pencil"></i></button>
                                        <button 
                                            class="btn btn-danger btn_delete_product" 
                                            idProduct="<?=$product['id']?>"
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
=              MODAL CREATE PRODUCT              =
============================================= -->
<div class="modal fade" id="modalAddProduct" role="dialog">
    <div class="modal-dialog">

        <div class="modal-content">
            <form role="form" method="POST" enctype="multipart/form-data">

                <div class="modal-header" style="background:#3c8dbc; color:white">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">Agregar Producto</h4>
                </div>

                <div class="modal-body">
                    <div class="box-body">

                        <!-- category and barcode input  -->
                        <div class="form-group row">
                            <!-- category input  -->
                            <?php
                                $categories = CategoriesController::ctrListCategories();
                            ?>
                            <div class="col-xs-12 col-sm-6 mb-xs">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-th"></i></span>
                                    <select id="newCategoryproduct" class="form-control " name="newProductCategory" required>
                                        <option value="" disabled selected>Seleccionar Categoría</option>
                                        <?php foreach ($categories as $key => $category) : ?>
                                            <option value="<?=$category['id']?>"><?=$category['name']?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        
                            <!-- code input  -->
                            <div class="col-xs-12 col-sm-6">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-fw fa-barcode"></i></span>
                                    <input id="newBarcode" class="form-control " type="text" name="newBarcode" placeholder="Código del producto" required readonly>
                                </div>
                            </div>
                        </div>

                        <!-- stock input  -->
                        <div class="form-group">
                            <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-cubes"></i></span>
                                    <input class="form-control " type="number" min="0" name="newStock" placeholder="Ingresar stock" required>
                                </div>
                            
                        </div>

                        <!-- description input  -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span>
                                <input class="form-control " type="text" name="newDescription" placeholder="Ingresar descripción del producto" required>
                            </div>
                        </div>
                        


                        <div class="form-group row" style="margin-bottom: 0;">                      
                            <!-- cost price input  -->
                            <div class="col-xs-12 col-sm-6 mb-xs">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa  fa-usd"></i></span>
                                    <input class="form-control " type="number" step=0.01 min="0" id="newCostPrice" name="newCostPrice" placeholder="Ingresar costo del producto" required>
                                </div>
                            </div>

                            <!-- sell price input  -->
                            <div class="col-xs-12 col-sm-6">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-money"></i></span>
                                    <input class="form-control " type="number" step=0.01 min="0"  id="newSellPrice" name="newSellPrice" placeholder="Ingresar precio de venta" required>
                                </div>

                                <br>
                                <!--  percentage checkbox  -->
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label class="">
                                            <input type="checkbox" id="addProductCheckBox" class="minimal percentage">
                                            Utilizar Porcentaje
                                        </label>
                                    </div>
                                </div>

                                <!--  percentage input  -->
                                <div class="col-xs-6" style="padding:0">
                                    <div class="input-group">
                                        <input class="form-control newPercentage" id="sellPercentValue" type="number" min="0" value="40" readonly>
                                        <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- image upload  -->
                        <div class="form-group">
                            <div class="panel">SUBIR IMAGEN</div>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-fw fa-file-image-o"></i></span>
                                <input class="form-control newAvatar" type="file" name="newImageProduct">
                            </div>

                            <p class="help-block">Peso máximo 2 Mb</p>
                            <img class="img-thumbnail preview_image" width="100px" src="views/img/products/default/anonymous.png" alt="logo">
                        </div>
                        
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
                    <button type="submit" class="btn btn-primary">Guardar Producto</button>
                </div>

                <?php
                    ProductsController::ctrAddProduct();
                ?>

            </form>

        </div>
    </div>
</div>

<!-- =============================================
=                MODAL EDIT PRODUCT              =
============================================= -->
<div class="modal fade" id="modalEditProduct" role="dialog">
    <div class="modal-dialog">

        <div class="modal-content">
            <form role="form" method="POST" enctype="multipart/form-data">

                <div class="modal-header" style="background:#3c8dbc; color:white">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">Editar Producto</h4>
                </div>

                <div class="modal-body">
                    <div class="box-body">

                        <!-- category and barcode input  -->
                        <div class="form-group row">
                            <!-- category input  -->
                            <div class="col-xs-12 col-sm-6 mb-xs">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-th"></i></span>
                                    <select class="form-control " name="editCategoryproduct" readonly required>
                                        <option id="editCategoryproduct">categoria</option>                                       
                                    </select>
                                </div>
                            </div>
                        
                            <!-- code input  -->
                            <div class="col-xs-12 col-sm-6">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-fw fa-barcode"></i></span>
                                    <input id="editBarcode" class="form-control " type="text" name="editBarcode" required readonly>
                                </div>
                            </div>
                        </div>

                        <!-- stock input  -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-cubes"></i></span>
                                <input class="form-control " type="number" min="0" name="editStock" id="editStock" required>
                            </div>
                            
                        </div>

                        <!-- description input  -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span>
                                <input class="form-control " type="text" name="editDescription" id="editDescription" required>
                            </div>
                        </div>
                        


                        <div class="form-group row" style="margin-bottom: 0;">                      
                            <!-- cost price input  -->
                            <div class="col-xs-12 col-sm-6 mb-xs">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa  fa-usd"></i></span>
                                    <input class="form-control " type="number" step=0.01 min="0" id="editCostPrice" name="editCostPrice" required>
                                </div>
                            </div>

                            <!-- sell price input  -->
                            <div class="col-xs-12 col-sm-6">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-money"></i></span>
                                    <input class="form-control " type="number" step=0.01 min="0"  id="editSellPrice" name="editSellPrice" required>
                                </div>

                                <br>
                                <!--  percentage checkbox  -->
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label class="">
                                            <input type="checkbox" id="editProductCheckBox" class="minimal percentage">
                                            Utilizar Porcentaje
                                        </label>
                                    </div>
                                </div>

                                <!--  percentage input  -->
                                <div class="col-xs-6" style="padding:0">
                                    <div class="input-group">
                                        <input class="form-control newPercentage" id="editsellPercentValue" type="number" min="0" value="40" readonly>
                                        <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- image upload  -->
                        <div class="form-group">
                            <div class="panel">SUBIR IMAGEN</div>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-fw fa-file-image-o"></i></span>
                                <input class="form-control newAvatar" type="file" name="editImageProduct">
                            </div>

                            <p class="help-block">Peso máximo 2 Mb</p>
                            <img class="img-thumbnail preview_image" width="100px" src="views/img/products/default/anonymous.png" alt="logo">
                        </div>
                        
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
                    <button type="submit" class="btn btn-primary">Guardar Producto</button>
                </div>

                <?php
                    //ProductsController::ctrEditProduct();
                ?>

            </form>

        </div>
    </div>
</div>