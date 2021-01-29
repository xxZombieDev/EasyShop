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
                        <h5 class="card-title">Lista de Usuarios</h5>
                        <p>Usuarios actualmente dados de alta en el sistema</p>
                        <div class="table-responsive">
                        <!-- Creación de la Tabla con DataTables -->
                            <table id="zero_config" class="table table-striped table-bordered">
                            <!-- Datos de la cabecera de la tabla -->
                                <thead class="text-white bg-info">
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Apellido Paterno</th>
                                        <th>Apellido Materno</th>
                                        <th>Usuario</th>
                                        <th>Tipo de Usuario</th>
                                        <th>Foto</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Consulta a la tabla de usuarios 
                                            try {
                                                $sql = "SELECT * FROM usuarios";
                                                $resultado = $conexion->query($sql);     
                                            } catch (Exception $e) {
                                                $error = $e ->getMessage();
                                                echo $error;
                                            }
                                            // recorremos el contenido de la tabla
                                            while ($usuario = $resultado->fetch_assoc()) { ?>
                                    <tr>
                                    <!-- En cada celda de la tabla agregamos un atributo de la tabla usuarios -->
                                        <td><?php echo $usuario['NombreUs'] ?></td> <!-- Nombre del Usuario -->
                                        <td><?php echo $usuario['ApellidoP_Us'] ?></td> <!-- Apellido Paterno -->
                                        <td><?php echo $usuario['ApellidoM_Us'] ?></td> <!-- Apellido Materno -->
                                        <td><?php echo $usuario['Usuario'] ?></td> <!-- Nombre de Usuario, para login -->
                                        <td><?php echo $usuario['TipoUsuario'] ?></td> <!-- Tipo de usuario (nivel) -->
                                        <td><img src="img/usuarios/<?php echo $usuario['fotoUsuario'] ?>" alt="foto"
                                                class="rounded-circle" height="100"></td><!-- Imagen -->
                                        <td>
                                            <a href="editar-usuario.php?id=<?php echo $usuario['idUsuario'] ?>"
                                                class="btn btn-warning btn-flat margin">
                                                <i class="mdi mdi-account-edit"></i><!-- Boton editar usuario mediante el ID -->
                                            </a>
                                            <!-- Eliminar usuario mediante su ID -->
                                            <a href="#" data-id="<?php echo $usuario['idUsuario']; ?>"
                                                data-tipo="usuario" 
                                                class="btn btn-danger btn-flat margin borrar_registro">
                                                <i class="mdi mdi-account-remove"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php }?>
                                </tbody>
                            </table>
                            <!-- Botones para generar reportes -->
                            <div class="reportes text-center">
                            <!-- Reporte PDF -->
                                <a href="documents/reporte_PDF.php"><button class="btn btn-danger">
                                        <h2><i class="mdi mdi-file-pdf-box"></i></h2>Reporte PDF
                                    </button></a>
                                    <!-- Reporte en CSV Excel -->
                                <a href="documents/reporte_excel.php"><button class="btn btn-success">
                                        <h2><i class="mdi mdi-file-excel"></i></h2>Reporte Excel
                                    </button></a>
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
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <?php
    
            include 'template/footer.php';

        ?>