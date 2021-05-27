<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Administrar Ventas
        </h1>
        <ol class="breadcrumb">
            <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active">Ventas</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">

            <div class="box-header with-border">

                <a href="crear-venta" class="btn btn-primary">
                    Agregar Venta
                </a>

            </div>

            <div class="box-body">      
                <table class="table table-bordered table-striped dt-responsive customTables" width="100%">
                    <thead>
                        <tr>
                            <th class="table-width_sm">#</th>
                            <th>Factura</th>
                            <th>Cliente</th>
                            <th>Vendedor</th>
                            <th>Forma de Pago</th>
                            <th>Neto</th>
                            <th>Total</th>
                            <th>Fecha</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $sells = SellsController::ctrListSells();
                        ?>
                        <?php foreach ($sells as $key => $sell) : ?>
                            <tr>
                                <td class="table-width_sm"><?=$key+1?></td>
                                <td class="text-center"><?=Helpers::sellCodeViewGenerator($sell['sell_code'])?></td>
                                <td><?=$sell['client']?></td>
                                <td><?=$sell['vendor']?></td>
                                <td><?=$sell['payment_method']?></td>
                                <td>$ <?=number_format($sell['net_price'],2)?></td>
                                <td>$ <?=number_format($sell['total_price'],2)?></td>
                                <td>$ <?=$sell['createdAt']?></td>                     
                                <td>
                                    <div class="btn-group">
                                        <button 
                                            class="btn btn-primary btnPrint"                                
                                        ><i class="fa fa-print"></i></button>
                                        <?php if (Helpers::getPermission($_SESSION['user']['role'],["Administrador", "Gestor"])) : ?>
                                            <a 
                                                href="index.php?ruta=editar-venta&idsellToedit=<?=$sell['id']?>"
                                                class="btn btn-warning btn_edit_sell" 
                                            ><i class="fa fa-pencil"></i></a>
                                            <button 
                                                class="btn btn-danger btn_delete_sell" 
                                                idSell="<?=$sell['id']?>"
                                            ><i class="fa fa-trash"></i></button>
                                        <?php endif; ?>
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
=                  DELETE SELL                   =
============================================= -->
<?php
    SellsController::ctrDeleteSell();
?>
