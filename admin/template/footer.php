            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer text-center">
                All Rights Reserved by Matrix-admin. Designed and Developed by <a href="https://wrappixel.com">WrapPixel</a>.
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="assets/extra-libs/sparkline/sparkline.js"></script>
    <!--Wave Effects -->
    <script src="dist/js/waves.js"></script>
    <script src="assets/libs/sweetAlert2/js/sweetalert2.all.min.js"></script>

    <!-- Mis Scripts -->
    <script src="js/usuarios-ajax.js"></script>
    <script src="js/login-admin.js"></script>

    <!--Menu sidebar -->
    <script src="dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="dist/js/custom.min.js"></script>

    <!-- JS -->
    <script src="assets/libs/inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>
    <script src="dist/js/pages/mask/mask.init.js"></script>
    <script src="assets/libs/select2/dist/js/select2.full.min.js"></script>
    <script src="assets/libs/select2/dist/js/select2.min.js"></script>
    <script src="assets/libs/jquery-asColor/dist/jquery-asColor.min.js"></script>
    <script src="assets/libs/jquery-asGradient/dist/jquery-asGradient.js"></script>
    <script src="assets/libs/jquery-asColorPicker/dist/jquery-asColorPicker.min.js"></script>
    <script src="assets/libs/jquery-minicolors/jquery.minicolors.min.js"></script>
    <script src="assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="assets/libs/quill/dist/quill.min.js"></script>
    <script src="assets/extra-libs/DataTables/datatables.min.js"></script>
    <!-- Morris JS y Raphael Js para graficos -->
    <script src="assets/libs/chart/morris.min.js"></script>
    <script src="assets/libs/chart/raphael.min.js"></script>

    <script>
        /****************************************
         *       Tabla General              *
         ****************************************/

        $(function () {
            $('#zero_config').DataTable({
            'paging'      : true,
            'pageLength'  : 10,
            'lengthChange': false,
            'searching'   : true,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : true,
            'language'    : {
                    paginate: {
                        next: 'Siguiente',
                        previous: 'Anterior',
                        last: 'Ultimo',
                        first: 'Primero'
                    },
                    info: 'Mostrando del _START_ al _END_ de _TOTAL_ resultados',
                    emptyTable: 'No hay registros',
                    infoEmpty: 'Sin registros',
                    search: 'Buscar: '
            }
            })
            
            /**
             * @param data este es el que trae los datos del JSON generado
             */
            // Llamamos al servicio creado con la función getJSON de jQuery
            $.getJSON('includes/models/servicio-graficos.php', function(data){
                    // Creamos un nuevo objeto de Morris - En este caso un grafico lineal
                    // Tambien se podria utilizar Morris.Area o Morris.Bar
                    var line = new Morris.Line({
                        // Referenciamos el ID del DOM donde colocaremos el grafico
                    element: 'grafica-ventas',
                    resize: true, // Lo hacemos responsive
                    data: data, // agregamos los datos del Servicio
                    xkey: 'fecha', // En el eje X ponemos las fechas
                    ykeys: ['total'], // En el Y ponemos la cantidad de ventas
                    labels: ['Total de Ventas $'], // Opcionalmente podemos desplegar labels
                    lineColors: ['#1294f5'], // color de la linea
                    hideHover: 'auto' //ocultar automaticamente los labels
                    });

                    });

                    //Código para inicializar la libreria de calendario. Para campos date.
                    $('#fecha').datepicker({
                        autoclose: true
                    });



 
        });
    </script>


</body>

</html>