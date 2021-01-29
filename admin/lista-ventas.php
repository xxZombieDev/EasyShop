<?php
    include 'includes/models/sesiones.php';
    include 'template/header.php';
    include 'includes/conexion.php'

?>
    <!-- Page wrapper  -->
    <!-- ============================================================== -->
    <div class="page-wrapper">
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
            <!-- ============================================================== -->
            <!-- Start Page Content -->
            <!-- ============================================================== -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Lista de Ventas</h5>
                            <p>Observe las ventas que se han efectuado en su negocio</p>
                            <div class="table-responsive">
                                <table id="zero_config" class="table table-striped table-bordered">
                                    <thead class="text-white bg-info">
                                        <tr>
                                            <th>Folio de Venta</th>
                                            <th>Cliente</th>
                                            <th>Total</th>
                                            <th>Fecha de Venta</th>
                                            <th>Ver</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                            // consulta para traer las ventas
                                            try {
                                                $sql = "SELECT idVenta, CONCAT(NombreCli,' ', ApellidoP_Cli, ' ', ApellidoM_Cli) AS Nombre, totalVenta, FechaVenta 
                                                FROM ventas AS v INNER JOIN clientes AS c ON v.idCliente = c.idCliente";
                                                $resultado = $conexion->query($sql);     
                                            } catch (Exception $e) {
                                                $error = $e ->getMessage();
                                                echo $error;
                                            }
                                            while ($ventas = $resultado->fetch_assoc()) { ?>                                            
                                                <tr>
                                                    <td><?php echo $ventas['idVenta'] ?></td>
                                                    <td><?php echo $ventas['Nombre'] ?></td>
                                                    <td>$<?php echo $ventas['totalVenta'] ?>.00</td>
                                                    <td><?php echo $ventas['FechaVenta'] ?></td>
                                                    <td> 
                                                        <a href="detalle-venta.php?id=<?php echo $ventas['idVenta'] ?>" class="btn btn-success btn-flat margin" >
                                                            <i class="mdi mdi-eye" ></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php }?>   
                                    </tbody>
                                </table>
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
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <?php
    
            include 'template/footer.php';

        ?>