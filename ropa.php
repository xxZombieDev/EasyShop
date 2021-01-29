<?php
    include_once 'template/header.php';
    include_once 'includes/conexion.php';
?>

<title>EASYSHOP | Ropa</title>

  <!-- Sección de ROPA -->
  <section class="container-fluid mt-5">
      <div class="text-center mb-5">
      <h2>Ropa</h2>
      <input type="hidden" id="cliente" name="cliente" value="<?php if (isset($_SESSION['sesionIniciada'])) {
        echo $_SESSION['id'];
    } ?>">
        <h5>Las mejores marcas de ropa ahora disponibles</h5>
      </div>
      <div class="row">
        <!-- Consulta para rellenar los productos que sean de la categoria de ROPA -->
          <?php
            
            try {
                $sql = "SELECT * FROM productos WHERE Categoria = 'Ropa'";
                $resultado = $conexion->query($sql);     
            } catch (Exception $e) {
                $error = $e ->getMessage();
                echo $error;
            }
            // Ciclamos hasta rellenar todos los productos existentes de la categoria
            while ($producto = $resultado->fetch_assoc()) { 
         ?>  
        <div class="col-6 col-md-3">
            <div class="card">
                <img src="admin/img/productos/<?php echo $producto['fotoProducto'] ?>" class="card-img-top" alt="...">
                <div class="card-body">
                    <hr>
                    <h6 class="card-title"><?php echo $producto['NombreProducto'] ?></hp>
                        <br>
                        <b><span>$ <?php echo $producto['Precio'] ?></span></b>
                        <br><br>
                        <a href="producto.php?id=<?php echo $producto['idProducto'] ?>" data-toggle="tooltip" data-placement="bottom" class="btn btn-sm btn-info "
                            title="Ver producto"><i class="mdi mdi-eye"></i></a>
                        <button <?php 
                        #Si existe una sesión y esta iniciada, mostramos el id del producto para almacenarlo en BD
                        if (isset($_SESSION['sesionIniciada'])) 
                        {
                          if ($_SESSION['sesionIniciada']=="si") {
                              echo "data-id='".$producto['idProducto']."' ";
                          }
                          } else {
                            #Si no hay sesión con el ID 0 mandamos una alerta de que debe iniciar sesión para agregar a Fav
                              echo 'data-id="0"';
                          }
                          
                         ?> class="btn btn-sm btn-danger fav-btn" data-toggle="tooltip" data-placement="bottom" title="Añadir a Lista de Deseos"><i
                                class="mdi mdi-heart"></i></button>
                </div>
            </div>
        </div>
        <?php }?>
  </section>




<?php
    include_once 'template/footer.php';
?>