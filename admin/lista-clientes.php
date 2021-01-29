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
                            <h5 class="card-title">Lista de Clientes</h5>
                            <p>Clientes actuales del negocio</p>
                            <div class="table-responsive">
                                <table id="zero_config" class="table table-striped table-bordered">
                                    <thead class="text-white bg-info">
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Apellido Paterno</th>
                                            <th>Apellido Materno</th>
                                            <th>Correo</th>
                                            <th>Foto</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        //Consulta para traer los clientes de la base de datos
                                            try {
                                                $sql = "SELECT * FROM clientes";
                                                $resultado = $conexion->query($sql);     
                                            } catch (Exception $e) {
                                                $error = $e ->getMessage();
                                                echo $error;
                                            }
                                            while ($cliente = $resultado->fetch_assoc()) { ?>                                            
                                                <tr>
                                                <!-- Ciclamos hasta traer a todos los clientes -->
                                                    <td><?php echo $cliente['NombreCli'] ?></td>
                                                    <td><?php echo $cliente['ApellidoP_Cli'] ?></td>
                                                    <td><?php echo $cliente['ApellidoM_Cli'] ?></td>
                                                    <td><?php echo $cliente['CorreoUsuario'] ?></td>
                                                    <td><img src="img/clientes/<?php echo $cliente['fotoCliente'] ?>" alt="foto cliente" class="rounded-circle" height="100"></td>
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