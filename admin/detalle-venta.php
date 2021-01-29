<?php
    include 'includes/models/sesiones.php';
    include 'template/header.php';
    include 'includes/conexion.php';
    $id = $_GET['id'];
    if (!filter_var($id, FILTER_VALIDATE_INT)) {
        die("Error al procesar");
    }

?>
<div class="page-wrapper">
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <?php
            // consulta para rellenar los datos del cliente en la factura
            $sql = "SELECT idVenta, CONCAT(NombreCli,' ', ApellidoP_Cli, ' ', ApellidoM_Cli) AS Nombre, totalVenta, FechaVenta 
            FROM ventas AS v INNER JOIN clientes AS c ON v.idCliente = c.idCliente
            WHERE idVenta = $id";
            $resultado = $conexion->query($sql);
            $ventas = $resultado -> fetch_assoc();
        ?>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-body printableArea">
                    <h3><b>Venta </b> <span class="pull-right"><?php echo $ventas['idVenta'] ?></span></h3>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="pull-left">
                                <address>
                                    <h3><b class="text-primary">Mi Tiendita</b></h3>
                                    <p class="text-muted m-l-5">Instituto Tecnologico de Matehuala,
                                        <br /> Matehuala, San Luis Potosi</p>
                                </address>
                            </div>
                            <div class="pull-right text-right">
                            <!-- Datos del cliente -->
                                <address>
                                    <h3>Cliente</h3>
                                    <h4 class="font-bold"><?php echo $ventas['Nombre'] ?></h4>
                                    <p><b>Fecha de Venta :</b> <i class="fa fa-calendar"></i> <?php echo $ventas['FechaVenta'] ?></p>
                                </address>
                            </div>
                        </div> 
                        <div class="col-md-12">
                        <!-- Detalle de la venta -->
                            <div class="table-responsive m-t-40" style="clear: both;">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Producto</th>
                                            <th class="text-right">Cantidad</th>
                                            <th class="text-right">Precio Unitario</th>
                                            <th class="text-right">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php                                       
                                        try {
                                            // Consulta que trae los productos de la venta
                                            $sql = "SELECT NombreProducto, dv.Cantidad, dv.Precio, (dv.Cantidad * dv.Precio) as Total 
                                                    FROM detalleventas AS dv INNER JOIN productos as p ON dv.idProducto = p.idProducto 
                                                    WHERE idVenta = $id";
                                            $resultado = $conexion->query($sql);     
                                        } catch (Exception $e) {
                                            $error = $e ->getMessage();
                                            echo $error;
                                        }
                                        while ($productos = $resultado->fetch_assoc()) { ?>      
                                        <tr><!-- Los mostramos en una tabla los productos que se adquirieron-->
                                            <td><?php echo $productos['NombreProducto'] ?></td>
                                            <td class="text-right"><?php echo $productos['Cantidad'] ?> </td>
                                            <td class="text-right">$ <?php echo $productos['Precio'] ?></td>
                                            <td class="text-right">$ <?php echo $productos['Total'] ?></td>
                                        </tr>
                                        <?php }?> 
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="pull-right m-t-30 text-right">
                                <hr>
                                <!-- Mostramos el total -->
                                <h3><b>Total :</b> $<?php echo $ventas['totalVenta'] ?> MXN</h3>
                            </div>
                            <div class="clearfix"></div>
                            <div class="text-right">
                                <button class="btn btn-info"><a href="lista-ventas.php" class="text-white">Regresar</a></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ============================================================== -->
        <!-- End PAge Content -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Right sidebar -->
        <!-- ============================================================== -->
        <!-- .right-sidebar -->
        <!-- ============================================================== -->
        <!-- End Right sidebar -->
        <!-- ============================================================== -->
    </div>


    <?php

    include 'template/footer.php';

?>