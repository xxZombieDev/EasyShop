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
                <!-- Elementos a elegir -->
                <div class="card">
                    <form role="form" class="form-horizontal" id="guardar-registro-imagen"
                        name="guardar-registro-imagen" action="includes/models/modelo-productos.php"
                        method="POST"
                        enctype="multipart/form-data">
                        <div class="card-body">
                            <!-- Consulta base de datos -->
                            <?php
                                $sql = "SELECT * FROM productos WHERE idProducto = $id";
                                $resultado = $conexion->query($sql);
                                $producto = $resultado -> fetch_assoc();
                            ?>
                            <h4 class="card-title">Editar Producto</h4>
                            <h5>Edite la información del producto que usted considere</h5>
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
                                            placeholder="Nombre del producto" value="<?php echo $producto['NombreProducto']; ?>">
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
                                        <input type="number" class="form-control" id="precio" name="precio"
                                            placeholder="Precio en pesos" value="<?php echo $producto['Precio']; ?>">
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
                                            placeholder="Existencias" value="<?php echo $producto['Cantidad']; ?>">
                                    </div>
                                </div>
                            </div>
                            <!-- Pendiente -->
   
                            <!--  -->
                            <div class="form-group row">
                                <label for="categoria"
                                    class="col-md-3 text-left control-label col-form-label">Categoria</label>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i
                                                    class="mdi mdi-format-list-bulleted-type"></i></span>
                                        </div>
                                        <select name="categoriaEvento" class="form-control select2">
                                            <?php 
                                                try {
                                                    //Almacenamos categoria evento.
                                                    $categoriaActual = $producto['Categoria'];


                                                    //Realiza la consulta a la BD y obtiene todas las categorias.
                                                    $sql = "SELECT DISTINCT Categoria FROM productos";
                                                    $resultado = $conexion->query($sql);

                                                } catch(Exception $e){
                                                    echo "Error" . $e->getMessage(); 
                                                }

                                                while($categoria = $resultado->fetch_assoc()){

                                                    //Validamos si el ID extraído de la BD es igual al ID actual.
                                                    if($categoria['Categoria'] == $categoriaActual){ //Sí es igual que se quede seleccionado.
                                            ?>
                                                        <option value="<?php echo $categoria['Categoria']; ?>" selected> <?php echo $categoria['Categoria'];?> </option>
                                                    
                                            <?php
                                                    } else {
                                            ?>
                                                    <option value="<?php echo $categoria['Categoria']; ?>"> <?php echo $categoria['Categoria'];?> </option>
                                            <?php
                                                    } //fin if.
                                                } //fin while.
                                            ?>
                                        
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!--  -->
                            <div class="form-group row">
                                <label for="descripcion"
                                    class="col-md-3 text-left control-label col-form-label">Descripcion</label>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <textarea name="descripcion" id="descripcion" class="form-control" rows="5"
                                            placeholder="Agrega una descripcion del producto (opcional)"><?php echo $producto['Descrip']; ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <!--  -->
                            <div class="form-group row">
                                <label for="foto-actual"
                                    class="col-md-3 text-left control-label col-form-label">Imagen Actual:</label>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <img src="img/productos/<?php echo $producto['fotoProducto']; ?>" width="200px" alt="foto-producto" name="foto-actual" >
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="foto" class="col-md-3 text-left control-label col-form-label">Cargar nueva foto</label>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <input type="file" class="form-control" id="foto" name="foto">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="border-top">
                            <div class="card-body text-right">
                                    <input type="hidden" name="registro" value="actualizar">
                                    <input type="hidden" name="id_registro" value="<?php echo $id; ?>">
                                <button type="submit" class="btn btn-outline-primary">Actualizar</button>
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