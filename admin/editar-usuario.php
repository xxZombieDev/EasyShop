<?php
    include 'includes/models/sesiones.php';
    include 'template/header.php';
    include 'includes/conexion.php';
    $id = $_GET['id'];
    if (!filter_var($id, FILTER_VALIDATE_INT)) {
        die("Error al procesar");
    }

?>
        
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8">
                        <!-- Elementos formulario -->
                        <div class="card">
                            <form class="form-horizontal" id="guardar-registro-imagen"
                            name="guardar-registro-imagen" method="POST" action="includes/models/modelo-usuario.php"
                            enctype="multipart/form-data">
                                <div class="card-body">
                                    <h4 class="card-title">Editar usuario</h4>
                                    <h5>Rellene la información que se le solicita a continuación</h5>
                                    <h6>Ingrese la información personal</h6>
                                    <!-- Consulta base de datos -->
                                    <?php
                                        $sql = "SELECT * FROM usuarios WHERE idUsuario = $id";
                                        $resultado = $conexion->query($sql);
                                        $usuario = $resultado -> fetch_assoc();
                                    ?>

                                    <div class="form-group row">
                                        <label for="nombre" class="col-md-3 text-left control-label col-form-label">Nombre</label>
                                        <div class="col-md-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-account"></i></span>
                                                </div>
                                                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" value="<?php echo $usuario['NombreUs']; ?>">
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
                                                <input type="text" class="form-control" id="apellidop" name="apellidop" placeholder="Apellido Paterno"  value="<?php echo $usuario['ApellidoP_Us']; ?>">
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
                                                <input type="text" class="form-control" id="apellidom" name="apellidom" placeholder="Apellido Materno" value="<?php echo $usuario['ApellidoM_Us']; ?>">
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
                                    <div class="form-group row">
                                        <label for="foto-actual"
                                            class="col-md-3 text-left control-label col-form-label">Imagen Actual:</label>
                                        <div class="col-md-9">
                                            <div class="input-group">
                                                <img src="img/usuarios/<?php echo $usuario['fotoUsuario']; ?>" width="200px" alt="fotoUsuario" name="foto-actual" >
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
                                                <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Nombre de Usuario" value="<?php echo $usuario['Usuario']; ?>">
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
                                                        <?php 
                                                        try {
                                                            //Almacenamos el tipo de usuario.
                                                            $tipoActual = $usuario['TipoUsuario'];


                                                            //Realiza la consulta a la BD y obtiene todas los tipos de usuario.
                                                            $sql = "SELECT DISTINCT TipoUsuario FROM usuarios";
                                                            $resultado = $conexion->query($sql);

                                                        } catch(Exception $e){
                                                            echo "Error" . $e->getMessage(); 
                                                        }

                                                        while($tipos = $resultado->fetch_assoc()){

                                                            //Validamos si la categoria consultada es igual a alguna de las del select
                                                            if($tipos['TipoUsuario'] == $tipoActual){ //Sí es igual que se quede seleccionado.
                                                    ?>          <!-- Si es le añadimos el atributo select para que muestre ese tipo -->
                                                                <option value="<?php echo $tipos['TipoUsuario']; ?>" selected> <?php echo $tipos['TipoUsuario'];?> </option>
                                                            
                                                    <?php
                                                            } else {
                                                    ?>
                                                            <option value="<?php echo $tipos['TipoUsuario']; ?>"> <?php echo $tipos['TipoUsuario'];?> </option>
                                                    <?php
                                                            } //fin if.
                                                        } //fin while.
                                                    ?>
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
                                                <input type="password" class="form-control" id="contrasena" name="contrasena" 
                                                placeholder="Ingresa la contraseña">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="border-top">
                                    <div class="card-body text-right">
                                    <input type="hidden" name="registro" value="actualizar">
                                    <input type="hidden" name="id_registro" value="<?php echo $id; ?>">
                                        <button type="submit" class="btn btn-outline-primary">Guardar</button>
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