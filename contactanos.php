<?php include_once 'template/header.php'; ?>
      <title>EASYSHOP | Contacto</title>
  <!-- Contenedor donde se agregara el formulario de contacto -->
    <section class="container">
        <h3 class="text-center mt-5">Contactanos</h3>
        <div class="row">
        <!-- Hacemos uso de la GRID de Bootstrap para hacer responsivo nuestro diseño -->
            <div class="col-md-12">
                <p class="text-center">¿Necesitas contactarnos? Llena el siguiente formulario con tus datos</p>
                <!-- Inicio del formulario, le asignaremos un ID y un Name para luego hacer peticiones con JQuery -->
                <form class="form-horizontal" id="guardar-registro" name="guardar-registro" method="POST" action="includes/envio-contacto.php" >
                    <div class="card-body">
                    <!-- Campo para el ingreso del nombre -->
                        <h4 class="card-title">Rellena los siguientes datos</h4>
                        <div class="form-group row">
                            <label for="nombre" class="col-sm-2 text-left control-label col-form-label">Nombre</label>
                            <div class="col-sm-9">
                            <!-- Establecemos un ID y Name nombre -->
                                <input type="text" class="form-control" id="nombre" name="nombre"
                                    placeholder="Ingresa tu nombre" required>
                            </div>
                        </div>
                    <!-- Campo para el ingreso de apellidos -->
                        <div class="form-group row">
                            <label for="apellidos"
                                class="col-sm-2 text-left control-label col-form-label">Apellidos</label>
                            <div class="col-sm-9">
                            <!-- Establecemos un ID y Name apellidos -->
                                <input type="text" class="form-control" id="apellidos" name="apellidos"
                                    placeholder="Ingresa tus apellidos" required>
                            </div>
                        </div>
                    <!-- Campo para el ingreso del correo-->
                        <div class="form-group row">
                            <label for="correo" class="col-sm-2 text-left control-label col-form-label">Correo</label>
                            <div class="col-sm-9">
                            <!-- Establecemos un ID y Name correo -->
                                <input type="email" class="form-control" id="correo" name="correo"
                                    placeholder="Ingresa tu Correo" required>
                            </div>
                        </div>
                    <!-- Campo para el ingreso del comentario -->
                        <div class="form-group row">
                            <label for="comentarios"
                                class="col-sm-2 text-left control-label col-form-label">Comentarios</label>
                            <div class="col-sm-9">
                            <!-- Establecemos un ID y Name comentarios -->
                                <textarea class="form-control" id="comentarios" name="comentarios"
                                    placeholder="Agrega aqui tus comentarios" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="border-top">
                        <div class="card-body text-center">
                        <input type="hidden" name="registro" value="nuevo">
                    <!-- Boton tipo submit que hara envio de los datos -->
                        <button type="submit" class="btn bg-header text-white">Enviar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>


    <?php

        include_once 'template/footer.php';

    ?>