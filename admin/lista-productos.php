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
                            <h5 class="card-title">Lista de productos</h5>
                            <p>En este listado se muestra el inventario de productos</p>
                            <div class="table-responsive">
                                <table id="zero_config" class="table table-striped table-bordered">
                                    <thead class="text-white bg-info">
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Categoria</th>
                                            <th>Precio</th>
                                            <th>Cantidad</th>
                                            <th>Foto</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        
                                            try {
                                                $sql = "SELECT * FROM productos";
                                                $resultado = $conexion->query($sql);     
                                            } catch (Exception $e) {
                                                $error = $e ->getMessage();
                                                echo $error;
                                            }
                                            while ($producto = $resultado->fetch_assoc()) { ?>                                            
                                                <tr>
                                                    <td><?php echo $producto['NombreProducto'] ?></td>
                                                    <td><?php echo $producto['Categoria'] ?></td>
                                                    <td><?php echo $producto['Precio'] ?></td>
                                                    <td><?php echo $producto['Cantidad'] ?></td>
                                                    <td><img src="img/productos/<?php echo $producto['fotoProducto'] ?>" alt="foto" width="50"></td>
                                                    <td> 
                                                        <a href="editar-producto.php?id=<?php echo $producto['idProducto'] ?>" class="btn btn-warning btn-flat margin" >
                                                            <i class="mdi mdi-pencil" ></i>
                                                        </a>
                                                        <a href="#" data-id="<?php echo $producto['idProducto']; ?>" data-tipo="productos" class="btn btn-danger btn-flat margin borrar_registro">
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