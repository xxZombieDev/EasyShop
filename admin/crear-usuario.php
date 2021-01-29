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
                        <!-- Formulario para crear un nuevo usuario -->
                        <div class="card">
                        <!-- La información la mandamos por POST, y tendra identificadores para hacer solicituds via AJAX -->
                            <form class="form-horizontal" id="guardar-registro-imagen"
                            name="guardar-registro-imagen" method="POST" action="includes/models/modelo-usuario.php"
                            enctype="multipart/form-data">
                                <div class="card-body">
                                    <h4 class="card-title">Alta de Usuario</h4>
                                    <h5>Rellene la información que se le solicita a continuación</h5>
                                    <h6>Ingrese la información personal</h6>
                                    <div class="form-group row">
                                        <label for="nombre" class="col-md-3 text-left control-label col-form-label">Nombre</label>
                                        <div class="col-md-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-account"></i></span>
                                                </div>
                                                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="apellidop" class="col-md-3 text-left control-label col-form-label">Apellido Paterno</label>
                                        <div class="col-md-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-account"></i></span>
                                                </div>
                                                <input type="text" class="form-control" id="apellidop" name="apellidop" placeholder="Apellido Paterno">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="apellidom" class="col-md-3 text-left control-label col-form-label">Apellido Materno</label>
                                        <div class="col-md-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-account"></i></span>
                                                </div>
                                                <input type="text" class="form-control" id="apellidom" name="apellidom" placeholder="Apellido Materno">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="foto" class="col-md-3 text-left control-label col-form-label">Foto
                                            Usuario</label>
                                        <div class="col-md-9">
                                            <div class="input-group">
                                                <input type="file" class="form-control" id="foto" name="foto">
                                            </div>
                                        </div>
                                    </div>

                                    <hr>
                                    <h6>Ingrese los datos de acceso</h6>
                                    <div class="form-group row">
                                        <label for="usuario" class="col-md-3 text-left control-label col-form-label">Nombre de Usuario</label>
                                        <div class="col-md-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-account"></i></span>
                                                </div>
                                                <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Nombre de Usuario">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="tipo" class="col-md-3 text-left control-label col-form-label">Tipo de Usuario</label>
                                        <div class="col-md-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-account-circle"></i></span>
                                                </div>
                                                <select id="tipo" name="tipo" class="form-control">
                                                    <option value="Administrador">Administrador</option>
                                                    <option value="Ordinario">Ordinario</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="contrasena" class="col-md-3 text-left control-label col-form-label">Contraseña</label>
                                        <div class="col-md-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-lock"></i></span>
                                                </div>
                                                <input type="password" class="form-control" id="contrasena" name="contrasena" placeholder="Ingresa la contraseña">
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