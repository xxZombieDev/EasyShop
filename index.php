<?php
include 'template/header.php';
  include 'includes/conexion.php';
  ?>
<title>EASYSHOP | La mejor tienda en linea del noreste</title>
<!-- Carousel/Slider -->
<div id="productosCarousel" class="carousel slide carousel-fade" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#productosCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#productosCarousel" data-slide-to="1"></li>
        <li data-target="#productosCarousel" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="img/carousel/despensa.png" class="d-block w-100">
            <div class="carousel-caption d-none d-md-block">
            </div>
        </div>
        <div class="carousel-item">
            <img src="img/carousel/telefonia.png" class="d-block w-100">
        </div>
        <div class="carousel-item">
            <img src="img/carousel/linea-blanca-electronica.png" class="d-block w-100">
            <div class="carousel-caption d-none d-md-block">
            </div>
        </div>
    </div>
    <a class="carousel-control-prev" href="#productosCarousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Anterior</span>
    </a>
    <a class="carousel-control-next" href="#productosCarousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Siguiente</span>
    </a>
</div>

<hr>
<!-- Sección de Nuevos productos -->
<section class="container mt-5">
    <input type="hidden" id="cliente" name="cliente" value="<?php if (isset($_SESSION['sesionIniciada'])) {
        echo $_SESSION['id'];
    } ?>">
    <h3 class="text-center mb-5">Nuevos productos</h3>
    <div class="row">
        <!-- Se realiza una consulta con un filtro de traer los nuevos 6 productos registrados en la BD -->
        <?php
        
        try {
            $sql = "SELECT * FROM productos ORDER BY idProducto DESC LIMIT 4";
            $resultado = $conexion->query($sql);     
        } catch (Exception $e) {
            $error = $e ->getMessage();
            echo $error;
        }
        while ($producto = $resultado->fetch_assoc()) { 
      ?>

        <!-- CARD donde se rellenan los productos resultantes -->
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

<hr>
<!-- Seccíón mas vendidos -->
<section class="container mt-5">
    <h2 class="text-center mb-5">Mas vendidos</h2>
    <div class="row">
        <!-- Similar a productos nuevos, solo que se filtran los articulos con menos existencias -->
        <?php
  
  try {
      $sql = "SELECT * FROM productos ORDER BY cantidad ASC LIMIT 4";
      $resultado = $conexion->query($sql);     
  } catch (Exception $e) {
      $error = $e ->getMessage();
      echo $error;
  }
  while ($producto = $resultado->fetch_assoc()) { 
?>

        <!--CARD donde se rellenan los productos "Mas Vendidos"  -->
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