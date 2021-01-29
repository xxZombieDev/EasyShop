<?php
  include_once 'template/header.php';
  include 'includes/conexion.php';
  $id = $_GET['id'];
  // Consulta para rellenar los datos del cliente a traves del ID recibido del cliente
  $sql = "SELECT * FROM clientes WHERE idCliente = $id";
  $resultado = $conexion->query($sql);
  $cliente = $resultado -> fetch_assoc();


?>
<title>EASYSHOP | Mi Perfil </title>


  <!-- Contenedor donde se podra editar la información del cliente -->
  <section class="container">
        <h3 class="text-center mt-5">Mi Perfil</h3>
        <div class="row">
        <!-- Hacemos uso de la GRID de Bootstrap para hacer responsivo nuestro diseño -->
            <div class="col-md-12">
                <p class="text-center">Aqui puedes editar los datos de tu cuenta</p>
                <!-- Inicio del formulario, le asignaremos un ID y un Name para luego hacer peticiones con JQuery -->
                <form class="form-horizontal" id="editar-perfil" name="editar-perfil" action="includes/models/modelo-cliente.php"
                        method="POST" enctype="multipart/form-data" >
                    <div class="card-body">
                    <!-- Campo para el ingreso del nombre -->
                        <div class="form-group row">
                            <label for="nombre" class="col-sm-2 text-left control-label col-form-label">Nombre</label>
                            <div class="col-sm-9">
                            <!-- Establecemos un ID y Name nombre -->
                                <input type="text" class="form-control" id="nombre" name="nombre"
                                    placeholder="Ingresa tu nombre" value="<?php echo $cliente['NombreCli']; ?>" required>
                            </div>
                        </div>
                    <!-- Campo para el ingreso de apellidos -->
                        <div class="form-group row">
                            <label for="apellidop"
                                class="col-sm-2 text-left control-label col-form-label">Apellido Paterno</label>
                            <div class="col-sm-9">
                            <!-- Establecemos un ID y Name apellidos -->
                                <input type="text" class="form-control" id="apellidop" name="apellidop"
                                    placeholder="Apellido Materno" value="<?php echo $cliente['ApellidoP_Cli']; ?>" required>
                            </div>
                        </div>
                    <!-- Campo para el ingreso de apellidos -->
                    <div class="form-group row">
                            <label for="apellidom"
                                class="col-sm-2 text-left control-label col-form-label">Apellido Materno</label>
                            <div class="col-sm-9">
                            <!-- Establecemos un ID y Name apellidos -->
                                <input type="text" class="form-control" id="apellidom" name="apellidom"
                                    placeholder="Apellido Materno"  value="<?php echo $cliente['ApellidoM_Cli']; ?>" required>
                            </div>
                        </div>
                    <!-- Campo para el ingreso del correo-->
                        <div class="form-group row">
                            <label for="correo" class="col-sm-2 text-left control-label col-form-label">Correo</label>
                            <div class="col-sm-9">
                            <!-- Establecemos un ID y Name correo -->
                                <input type="email" class="form-control" id="correo" name="correo"
                                    placeholder="Ingresa tu Correo"  value="<?php echo $cliente['CorreoUsuario']; ?>" required>
                            </div>
                        </div>
                    <!-- Campo para el ingreso contraseña-->
                        <div class="form-group row">
                            <label for="correo" class="col-sm-2 text-left control-label col-form-label">Contraseña</label>
                            <div class="col-sm-9">
                            <!-- Establecemos un ID y Name correo -->
                                <input type="password" class="form-control" id="contrasena" name="contrasena"
                                    placeholder="Tu contraseña" >
                            </div>
                        </div>
                        <!-- Foto Actual -->
                        <div class="form-group row">
                                <label for="foto-actual"
                                    class="col-sm-2 text-left control-label col-form-label">Imagen Actual:</label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <img src="admin/img/clientes/<?php echo $cliente['fotoCliente']; ?>" width="200px" alt="foto-cliente" name="foto-actual" >
                                    </div>
                                </div>
                            </div>
                            <!-- Input para cambiar la imagen si es necesario -->
                            <div class="form-group row">
                                <label for="foto" class="col-sm-2 text-left control-label col-form-label">Cargar nueva foto</label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <input type="file" class="form-control" id="foto" name="foto">
                                    </div>
                                </div>
                            </div>
                    </div>

                    <div class="border-top">
                        <div class="card-body text-center">
                        <input type="hidden" name="registro" value="editar">
                        <input type="hidden" name="id_registro" value="<?php echo $id; ?>">
                    <!-- Boton tipo submit que hara envio de los datos -->
                        <button type="submit" class="btn btn-primary">Actualizar Perfil</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>


<?php 
    include_once 'template/footer.php';
?>