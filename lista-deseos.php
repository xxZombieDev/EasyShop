<?php 
include_once 'template/header.php';
include_once 'includes/conexion.php';
?>
<!-- Información estatica en sección NOSOTROS -->
<title>EASYSHOP | Mi Lista de Deseos</title>

<div class="container mt-3">
    <h2 class="text-center">Mi Lista de Deseos</h2>
</div>

<!-- 
    
 -->
<article class="container">
    <div class="row">
    <?php
        
        $cliente = $_SESSION['id'];
        try {
            $sql = "SELECT P.*, LD.idDeseo FROM listadeseos as LD INNER JOIN productos as P ON LD.idProducto = P.idProducto WHERE idCliente = $cliente";
            $resultado = $conexion->query($sql);     
        } catch (Exception $e) {
            $error = $e ->getMessage();
            echo $error;
        }
        while ($producto = $resultado->fetch_assoc()) { 
      ?>

        <div class="col-12 col-sm-6 col-md-4">
            <div class="card">
                <img src="admin/img/productos/<?php echo $producto['fotoProducto'] ?>" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $producto['NombreProducto'] ?></h5>
                    <p class="card-text"><?php echo $producto['Descrip'] ?></p>
                    <div class="row">
                        <div class="col-6">
                            <b> $<?php echo $producto['Precio'] ?>.00</b>
                        </div>
                        <div class="col-6 text-right">
                            <a href="producto.php?id=<?php echo $producto['idProducto'] ?>"><button class="btn btn-sm btn-info" data-toggle="tooltip" data-placement="bottom"
                                title="Ver Producto"><i class="mdi mdi-eye"></i></button></a>
                            <button class="btn btn-sm btn-danger btn-delFav" data-product="<?php echo $producto['idDeseo'] ?>" data-toggle="tooltip" data-placement="bottom"
                                title="Retirar de Lista de Deseos"><i class="mdi mdi-delete"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php }?>
    </div>
</article>

<?php
  include_once 'template/footer.php';
?>