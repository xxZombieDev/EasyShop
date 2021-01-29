<?php 
    include 'includes/models/sesiones.php';
    include 'template/header.php';
    include 'includes/importar_bd.php';
?>    
<!-- ============================================================== -->
<!-- Page wrapper  -->
<!-- ============================================================== -->
<div class="page-wrapper">
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid bg-white">
    <h3 class="text-center text-white bg-dark p-4">Respaldos</h3>
        <div class="card">
            <div class="row">
                <div class="col-md-6 text-center border border-dark">
                    <h4>Generar Respaldo</h4>
                    <label>Seleccione el siguiente boton para poder generar un respaldo de su base de datos</label>
                    <div class="reportes text-center mt-3">
                        <a href="includes/generar_respaldo.php"><button class="btn btn-info"><h2><i class="mdi mdi-database"></i></h2>Generar</button></a>
                    </div>
                </div>
                <div class="col-md-6 text-center border border-dark">
                    <h4>Importar Respaldo</h4>
                    <form method="post" enctype="multipart/form-data">
                        <div>
                            <input type="file" name="database" /> 
                        </div>
                        <br>
                        <div class="reportes text-center mb-2">
                        <button type="submit" name="import" class="btn btn-info" value="Importar"><h2><i class="mdi mdi-database"></i></h2>Importar</button>
                        </div>
                    </form>
                    <div><?php echo $message; ?></div>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->

<?php 
    include 'template/footer.php';
?>            