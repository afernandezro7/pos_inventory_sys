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
                        <tr>
                            <td class="table-width_sm">1</td>
                            <td>1000123</td>
                            <td>Ariel Villegas</td>
                            <td>Julio Martinez</td>
                            <td>TC-12412441261221</td>
                            <td>$ 1,000.00</td>
                            <td>$ 1,190.00</td>
                            <td>Hace 2 dias</td>                       
                            <td>
                                <div class="btn-group">
                                    <button 
                                        class="btn btn-primary btnPrint"                                
                                    ><i class="fa fa-print"></i></button>
                                    <button 
                                        class="btn btn-danger btn_delete_sell" 
                                        idSell="1"
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

