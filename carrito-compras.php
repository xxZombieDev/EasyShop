<?php include_once 'template/header.php';
include 'includes/conexion.php';
?>
  <title>EASYSHOP | Carrito de Compras</title>
 <style>
 /*
 * Carrito de compras
 */
td {
    font-size: 12px;
}

th {
    font-size: 12px;
}
 </style>
 <section class="container mt-5">
     <div class="text-center">
         <h3>Resumen de Carrito de Compras</h3>
         <p>Aqui encontraras los productos que deseas adquirir</p>
     </div>
     <div class="table-responsive">
         <table id="zero_config" class="table table-striped table-bordered">
             <thead class="text-white bg-info">
                 <tr>
                     <th>Articulo</th>
                     <th>Precio</th>
                     <th>Piezas</th>
                     <th>Total</th>
                     <th></th>

                 </tr>
             </thead>
             <tbody>
                 <?php                
                try {
                    // Consulta para rellenar los articulos que tenemos temporalmente en carrito de compras
                    $temporal =  $_SESSION['id'];
                    $sql = "SELECT NombreProducto,dv.idProducto, dv.Precio, dv.Cantidad, (dv.Precio * dv.Cantidad) AS Total 
                            FROM detalleventas as dv INNER JOIN productos AS p ON p.idProducto = dv.idProducto
                             WHERE ClienteTemp = $temporal";
                    $resultado = $conexion->query($sql);     
                   
                } catch (Exception $e) {
                    $error = $e ->getMessage();
                    echo $error;
                }
                while ($producto = $resultado->fetch_assoc()) { 
            ?>
                 <!-- Articulos -->
                 <tr>
                     <td><?php echo $producto['NombreProducto'] ?></td>
                     <td>$<?php echo $producto['Precio'] ?>.00</td>
                     <td><?php echo $producto['Cantidad'] ?></td>
                     <td>$<?php echo $producto['Total'] ?>.00</td>
                     <td><button data-id="<?php echo $producto['idProducto']; ?>"
                             class="btn btn-sm btn-danger borrar_registro"><i class="mdi mdi-delete"></i></button></td>
                 </tr>
                 <?php }?>
             </tbody>
         </table>
         <!-- Calculo del Total del Carrito -->
         <?php
            $sql = "SELECT SUM(dv.Precio * dv.Cantidad) AS Total 
                    FROM detalleventas as dv INNER JOIN productos AS p ON p.idProducto = dv.idProducto  
                    WHERE ClienteTemp = $temporal
                    GROUP BY ClienteTemp ";
            
            $resultado = $conexion->query($sql);
            $producto = $resultado -> fetch_assoc();
        
            
        ?>
         <div class="text-right m-3">
             <h5>Total:
                 $<span><?php if (!empty($producto['Total'])) { echo $producto['Total']; } else { echo 0; } ?>.00</span>
             </h5>
         </div>
         <!-- Pagar venta -->
         <form method="POST" action="includes/pagar.php"
             class="text-right">
             <input type="hidden" name="total" id="total"
                 value="<?php if (!empty($producto['Total'])) { echo $producto['Total']; } else { echo 0;} ?>">
             <input type="hidden" name="descripcion" value="Compra en EASYSHOP">
             <button class="btn btn-info" type="submit" <?php if (empty($producto['Total'])) { echo "hidden"; } ?>>Pagar</button>
         </form>
     </div>
 </section>


 <?php
    include_once 'template/footer.php';
?>