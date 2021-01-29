<?php
  include_once 'template/header.php';
  include 'includes/conexion.php';
  $id = $_GET['id'];
// Consulta que trae los datos del producto que queremos visualizar a traves del ID
// recibido por Metodo GET
  $sql = "SELECT * FROM productos WHERE idProducto = $id";
  $resultado = $conexion->query($sql);
  $producto = $resultado -> fetch_assoc();


?>
<!-- Agregar nombre producto -->
<title>EASYSHOP | <?php echo $producto['NombreProducto']  ?> </title>

<style>
@media (min-width: 40em) {


    .featurette-heading {
        font-size: 50px;
    }
}

@media (min-width: 62em) {
    .featurette-heading {
        margin-top: 7rem;
    }
}


.featurette-heading {
    font-weight: 300;
    line-height: 1;
    letter-spacing: -.05rem;
}
</style>
<section class="container mt-5">
    <div class="row featurette">
        <div class="col-sm-7 order-md-2">
            <!-- Nombre Producto -->
            <h2 class="featurette-heading"><?php echo $producto['NombreProducto']  ?>
            </h2>
            <!-- Descripción del producto -->
            <p class="lead"><?php echo $producto['Descrip']  ?></p>
        </div>
        <div class="col-sm-5 order-md-1">
            <!-- Foto Producto -->
            <img src="admin/img/productos/<?php echo $producto['fotoProducto']?>"
                class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" width="400"
                height="400">
        </div>
    </div>
    <div class="info-venta mt-2">
        <!-- Agregar al carrito de compras -->
        <form method="POST" id="guardar-registro" name="guardar-registro" action="includes/models/modelo-ventas.php">
            <!-- Precio Producto -->
            <h3>Precio: $<?php echo $producto['Precio']?>.00 MXN</h3>
            <h6>IVA incluido</h6>
            <!-- Cantidad de productos - En atributo MAX poner el valor de inventario -->
            <input type="hidden" name="product" id="product" value="<?php echo $producto['idProducto']?>">
            <input type="hidden" name="precio" id="precio" value="<?php echo $producto['Precio']?>">
            <input type="hidden" name="temporal" id="temporal" value="<?php echo $_SESSION['id']?>">

            <!-- Valiadación PHP compras, si esta logueado puede comprar productos y si no, se le sugiere que inicie sesión -->
            <?php
            
                if (isset($_SESSION['sesionIniciada'])) {
                    if ($_SESSION['sesionIniciada']=="si") {
                        echo '
                        <label for="cantidad"> <b>Cantidad:</b> </label> 
                        <input type="number" class="form-control col-2 col-md-1 mb-2" name="cantidad" id="cantidad" min="1" max="'.$producto['Cantidad'].'">
                        <input type="hidden" name="registro" value="carrito"> 
                        <button type="submit" id="agregaCarrito" class="btn btn-primary"><i class="mdi mdi-cart"></i> Agregar al Carrito</button>
                        ';
                    }
                } else {
                    echo '<h6 class="text-danger">Debes iniciar sesión para poder comprar el producto</h6>';
                }

            ?>

        </form>
    </div>
</section>

<section class="container mt-5">
    <h4>Comentarios del producto</h4>
    <div class="card">
        <div class="comment-widgets scrollable ps-container ps-theme-default"
            data-ps-id="621f20f3-21d2-27c8-641e-5ee443f9c9ef">
            <!-- Comentarios del producto  -->

            <?php
                //Consulta
                $sql2 = "SELECT CONCAT(NombreCli,' ',ApellidoP_Cli) AS Nombre,
                        fotoCliente, Opinion, fecha
                        FROM productos AS P INNER JOIN opinionproducto AS OP ON P.idProducto = OP.idProducto
                        INNER JOIN clientes AS C ON OP.idCliente = C.idCliente
                        WHERE P.idProducto = $id";

                $resultado = $conexion->query($sql2);
                while ($opinion = $resultado->fetch_assoc()) {
            
            ?>
            <div class="d-flex flex-row comment-row m-3">
                <div class="p-2"><img src="admin/img/clientes/<?php echo $opinion['fotoCliente']?>" alt="user"
                        width="50" class="rounded-circle">
                </div>
                <div class="comment-text w-100">
                    <h6 class="font-medium"><?php echo $opinion['Nombre']?><span class="mr-2"
                            style="float:right;"><?php echo $opinion['fecha']?></span></h6>
                    <span class="m-b-15 d-block"><?php echo $opinion['Opinion']?></span>
                </div>
            </div>
            <hr>
            <!-- 
                Validación PHP - Si el usuario tienen sesión iniciada puede dar su opinion sobre un producto
                en casocontrario se le sugiere que inicie sesión para poder hacerlo
            -->
            <?php }
            if (isset($_SESSION['sesionIniciada'])) {
                if ($_SESSION['sesionIniciada']=="si") {
                    echo '
                        <div class="card-body border-top">
                            <form class="row" method="POST" id="guardar-comentario" name="guardar-comentario" action="includes/models/modelo-opinion.php">
                                <div class="col-9">
                                    <div class="input-field m-t-0 m-b-0">
                                        <textarea id="comentario" name="comentario" placeholder="Escribe tu comentario aqui" class="form-control" style="margin-top: 0px; margin-bottom: 0px; height: 76px;"></textarea>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <input type="hidden" name="registro" value="nuevo"> 
                                    <input type="hidden" name="producto" id="producto" value="'.$producto['idProducto'].'">
                                    <input type="hidden" name="cliente" id="cliente" value="'.$_SESSION['id'].'">
                                    <button class="btn btn-lg  btn-primary float-right m-2" type="submit"><i class="mdi mdi-send"></i></button>
                                </div>
                            </form>
                        </div>';
                        
                }
            } else {
                echo '<h6 class="text-danger text-center">Debes iniciar sesión para poder hacer comentarios del producto</h6>';
            }
            
            ?>

        </div>
    </div>
</section>

<!-- Sección de Similares -->
<section class="container mt-5">
    <h2 class="text-center mb-5">Productos similares</h2>
    <div class="row">

        <!-- Para poder traer productos similares hacemos una consulta, filtrando los productos hacia la misma categoria del producto visible actualmente -->
        <?php
  
  $categoria = $producto['Categoria'];
  try {
      $sql = "SELECT * FROM productos WHERE Categoria = '$categoria' ORDER BY idProducto DESC LIMIT 3";
      $resultado = $conexion->query($sql);     
  } catch (Exception $e) {
      $error = $e ->getMessage();
      echo $error;
  }
  while ($similar = $resultado->fetch_assoc()) { 
?>

        <!-- Productos similares -->
        <div class="col-md-4 col-sm-6">
            <div class="card">
                <img src="admin/img/productos/<?php echo $similar['fotoProducto'] ?>" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $similar['NombreProducto'] ?></h5>
                    <hr>
                    <p class="card-text"><?php echo $similar['Descrip'] ?></p>
                    <h6>Precio: <span>$ <?php echo $similar['Precio'] ?> MXN</span></h6>
                    <a href="producto.php?id=<?php echo $similar['idProducto'] ?>" data-toggle="tooltip" data-placement="bottom" class="btn btn-sm btn-info "
                            title="Ver producto"><i class="mdi mdi-eye"></i></a>
                            <button <?php 
                        #Si existe una sesión y esta iniciada, mostramos el id del producto para almacenarlo en BD
                        if (isset($_SESSION['sesionIniciada'])) 
                        {
                          if ($_SESSION['sesionIniciada']=="si") {
                              echo "data-id='".$similar['idProducto']."' ";
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