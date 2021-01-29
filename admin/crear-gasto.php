<?php
// exportamos el archivo de sesiones para verificar que el usuario este autentificad
    include 'includes/models/sesiones.php';
    // exportamos el header
    include 'template/header.php';

?>

<!-- Page wrapper  -->
<!-- ============================================================== -->
<div class="page-wrapper">
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8">
            <!-- Formulario para dar de alta un nuevo gasto -->
            <div class="card">
                <form role="form" class="form-horizontal" id="guardar-registro" name="guardar-registro"
                    action="includes/models/modelo-gastos.php" method="POST" enctype="multipart/form-data">
                    <div class="card-body">
                        <h4 class="card-title">Alta de Gasto</h4>
                        <h5>Rellene la siguiente información del Gasto</h5>
                        <div class="form-group row">
                            <label for="motivo" class="col-md-3 text-left control-label col-form-label">Motivo del
                                Gasto</label>
                            <div class="col-md-9">
                                <div class="input-group">
                                    <textarea name="motivo" id="motivo" class="form-control" rows="4"
                                        placeholder="Agregue el motivo del Gasto"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="monto" class="col-md-3 text-left control-label col-form-label">Monto</label>
                            <div class="col-md-9">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i
                                                class="mdi mdi-cash"></i></span>
                                    </div>
                                    <input type="text" class="form-control" id="monto" name="monto"
                                        placeholder="Monto en pesos">
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fecha" class="col-md-3 text-left control-label col-form-label">Fecha</label>
                            <div class="col-md-9">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i
                                                class="mdi mdi-calendar"></i></span>
                                    </div>
                                    <input type="text" class="form-control" id="fecha" name="fecha"
                                        placeholder="dd/mm/yyyy">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="border-top">
                        <div class="card-body text-right">
                            <input type="hidden" name="registro" value="nuevo">
                            <button type="submit" class="btn btn-outline-primary">Registrar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <?php

    include 'template/footer.php';

?>