<?php 
    include 'includes/models/sesiones.php';
    include 'includes/conexion.php';
    include 'template/header.php';
?>    
<!-- ============================================================== -->
<!-- Page wrapper  -->
<!-- ============================================================== -->
<div class="page-wrapper">
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Contenedores de información  -->
        <!-- ============================================================== -->

        <?php
            $sql = "SELECT COUNT(*) as Usuarios FROM usuarios";
            $resultado = $conexion->query($sql);
            $usuario = $resultado -> fetch_assoc();
        ?>
        <!-- En resumen contamos los registros de cada tabla, en caso de ventas y gastos se suman los totales -->
        <h2>Resumen</h2>
        <div class="row">
            <!-- Total de Usuarios -->
            <div class="col-md-6 col-lg-4 col-xlg-3">
                <div class="card card-hover">
                    <div class="box bg-cyan text-center">
                        <h1 class="font-light text-white"><i class="mdi mdi-account"></i></h1>
                        <h4 class="text-white"><?php echo $usuario['Usuarios']; ?></h4>
                        <h6 class="text-white">Usuarios</h6>
                    </div>
                </div>
            </div>
            <!-- Total de Productos -->
            <?php

                $sql = "SELECT COUNT(*) as Producto FROM productos";
                $resultado = $conexion->query($sql);
                $producto = $resultado -> fetch_assoc();

            ?>
            <div class="col-md-6 col-lg-4 col-xlg-3">
                <div class="card card-hover">
                    <div class="box bg-success text-center">
                        <h1 class="font-light text-white"><i class="mdi mdi-food"></i></h1>
                        <h4 class="text-white"><?php echo $producto['Producto'];  ?></h4>
                        <h6 class="text-white">Productos</h6>
                    </div>
                </div>
            </div>
            <!-- Total de Clientes -->
            <?php

                $sql = "SELECT COUNT(*) as Cliente FROM clientes";
                $resultado = $conexion->query($sql);
                $cliente = $resultado -> fetch_assoc();

            ?>
            <div class="col-md-6 col-lg-4 col-xlg-3">
                <div class="card card-hover">
                    <div class="box bg-danger text-center">
                        <h1 class="font-light text-white"><i class="mdi mdi-account-multiple"></i></h1>
                        <h4 class="text-white"><?php echo $cliente['Cliente']; ?></h4>
                        <h6 class="text-white">Clientes</h6>
                    </div>
                </div>
            </div>
                <!-- Total de Ventas -->
                <?php

                $sql = "SELECT SUM(totalVenta) AS Ventas FROM ventas";
                $resultado = $conexion->query($sql);
                $ventaTotal = $resultado -> fetch_assoc();

                ?>
            <div class="col-md-6 col-lg-4 col-xlg-3">
                <div class="card card-hover">
                    <div class="box bg-cyan text-center">
                        <h1 class="font-light text-white"><i class="mdi mdi-cash"></i></h1>
                        <h4 class="text-white">$<?php echo $ventaTotal['Ventas'];  ?> MXN</h4>
                        <h6 class="text-white">Ventas</h6>
                    </div>
                </div>
            </div>
            <!-- Total de Gastos -->
                <?php

                $sql = "SELECT SUM(MontoGasto) AS Gasto FROM gastos";
                $resultado = $conexion->query($sql);
                $gastoTotal = $resultado -> fetch_assoc();

                ?>
            <div class="col-md-6 col-lg-4 col-xlg-3">
                <div class="card card-hover">
                    <div class="box bg-success text-center">
                        <h1 class="font-light text-white"><i class="mdi mdi-cash"></i></h1>
                        <h4 class="text-white">$<?php echo $gastoTotal['Gasto'];?> MXN</h4>
                        <h6 class="text-white">Gastos</h6>
                    </div>
                </div>
            </div>
        </div>

                <!-- Grafico de Morris JS -->
                <!-- En el footer esta el service -->
                <div>
            <h2>Grafico de Ventas</h2>
            <div class="box-body chart-responsive">
              <div class="chart" id="grafica-ventas" style="height: 300px;"></div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->

<?php 
    include 'template/footer.php';
?>            