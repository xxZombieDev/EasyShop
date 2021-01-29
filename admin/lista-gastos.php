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
                            <h5 class="card-title">Lista de Gastos</h5>
                            <p>En esta tabla se muestran los gastos efectuados en el negocio</p>
                            <div class="table-responsive">
                                <table id="zero_config" class="table table-striped table-bordered">
                                    <thead class="text-white bg-info">
                                        <tr>
                                            <th>Folio Gasto</th>
                                            <th>Motivo del Gasto</th>
                                            <th>Monto</th>
                                            <th>Fecha</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        
                                            try {
                                                $sql = "SELECT * FROM gastos";
                                                $resultado = $conexion->query($sql);     
                                            } catch (Exception $e) {
                                                $error = $e ->getMessage();
                                                echo $error;
                                            }
                                            while ($gasto = $resultado->fetch_assoc()) { ?>                                            
                                                <tr>
                                                    <td><?php echo $gasto['idGasto'] ?></td>
                                                    <td><?php echo $gasto['MotivoGasto'] ?></td>
                                                    <td><?php echo $gasto['MontoGasto'] ?></td>
                                                    <td><?php echo $gasto['FechaGasto'] ?></td>
                                                    <td> 
                                                        <a href="#" data-id="<?php echo $gasto['idGasto']; ?>" data-tipo="gastos" class="btn btn-danger btn-flat margin borrar_registro">
                                                            <i class="mdi mdi-delete"></i>
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