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
                <!-- Elementos a elegir -->
                <div class="card">
                    <form role="form" class="form-horizontal" id="guardar-registro-imagen"
                        name="guardar-registro-imagen" action="includes/models/modelo-productos.php"
                        method="POST"
                        enctype="multipart/form-data">
                        <div class="card-body">
                            <h4 class="card-title">Alta de Producto</h4>
                            <h5>Rellene la siguiente información del producto</h5>
                            <div class="form-group row">
                                <label for="nombre" class="col-md-3 text-left control-label col-form-label">Nombre del
                                    producto</label>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i
                                                    class="fas fa-box"></i></span>
                                        </div>
                                        <input type="text" class="form-control" id="nombre" name="nombre"
                                            placeholder="Nombre del producto">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="precio"
                                    class="col-md-3 text-left control-label col-form-label">Precio</label>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i
                                                    class="mdi mdi-cash"></i></span>
                                        </div>
                                        <input type="text" class="form-control" id="precio" name="precio"
                                            placeholder="Precio en pesos">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="existencias"
                                    class="col-md-3 text-left control-label col-form-label">Existencias</label>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i
                                                    class="fas fa-boxes"></i></span>
                                        </div>
                                        <input type="number" class="form-control" id="existencias" name="existencias"
                                            placeholder="Existencias">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="categoria"
                                    class="col-md-3 text-left control-label col-form-label">Categoria</label>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i
                                                    class="mdi mdi-format-list-bulleted-type"></i></span>
                                        </div>
                                        <select id="categoria" name="categoria" class="form-control">
                                            <option value="Canasta Basica">Canasta Basica</option>
                                            <option value="Aseo del Hogar">Aseo del Hogar</option>
                                            <option value="Ropa">Ropa</option>
                                            <option value="Electrodomesticos">Electrodomesticos</option>
                                            <option value="Tecnologia">Tecnologia</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="descripcion"
                                    class="col-md-3 text-left control-label col-form-label">Descripcion</label>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <textarea name="descripcion" id="descripcion" class="form-control" rows="5"
                                            placeholder="Agrega una descripcion del producto (opcional)"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="foto" class="col-md-3 text-left control-label col-form-label">Foto
                                    producto</label>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <input type="file" class="form-control" id="foto" name="foto">
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