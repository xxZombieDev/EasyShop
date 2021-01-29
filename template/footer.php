    <!-- Pie de Pagina -->
    <footer class="footer bg-header mt-5 py-4">
        <div class="container text-center">
            <p class="text-white">EASYSHOP - Todos los Derechos Reservados</p>
        </div>
    </footer>

    <script src="js/vendor/modernizr-3.11.2.min.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/plugins.js"></script>
    <script src="admin/assets/libs/sweetAlert2/js/sweetalert2.all.min.js"></script>
    <script src="admin/assets/extra-libs/DataTables/datatables.min.js"></script>
    <script src="js/contacto-ajax.js"></script>
    <script src="js/cliente-ajax.js"></script>



    <script>
/****************************************
 *       Tabla General              *
 ****************************************/

var id = $(this).attr('data-id');
var idC = $('#cliente').val();

$(document).ready(function() {

            $('[data-toggle="tooltip"]').tooltip();

            // Agregamos a Lista de deseos
            $('.fav-btn').on('click', function(e) {
                e.preventDefault();
                var id = $(this).attr('data-id');
                if (id == 0) {
                    alert("Debes iniciar sesión para realizar esta acción");
                } else {
                    $.ajax({
                        type: "post",
                        url: "includes/models/modelo-favoritos.php",
                        data: {
                            'idCliente': idC,
                            'idProducto': id,
                            'registro': 'favorito'
                        },
                        dataType: "JSON",
                        success: function(data) {
                            // La información obtenida de AJAX la almacenamos en una variabñe
                            var resultado = data;
                            console.log(data);
                            // Verificamos si la respuesta fue correcta, por eso el arreglo en PHP
                            if (resultado.respuesta == "correcto") {
                                // Si fue correcto con Sweet alert notificamos la inserción exitosa 
                                swal('Correcto!',
                                    'Se ha añadido este producto a tu lista de deseos!!',
                                    'success');
                                // En caso de error mandamos un mensaje de que hubo un error
                            }
                        }
                    });
                }
            });

            // Eliminamos de la lista de deseos
            $(".btn-delFav").on("click", function(e) {
                e.preventDefault();

                var id = $(this).attr("data-product");

                swal({
                    title: "¿Estás Seguro?",
                    text: "Se eliminara este producto de tu lista de deseos",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Si, borrar!!",
                    cancelButtonText: "No, Cancelar",
                    confirmButtonClass: "btn btn-success",
                    cancelButtonClass: "btn btn-danger",
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            type: "post",
                            data: {
                                id: id,
                                registro: "borrarFav",
                            },
                            url: "includes/models/modelo-favoritos.php",
                            success: function(data) {
                                var resultado = JSON.parse(data);

                                if (resultado.respuesta === "correcto") {
                                    swal(
                                        "Eliminado",
                                        "Producto eliminado de favoritos",
                                        "success"
                                    );
                                    setTimeout(function() {
                                        window.location.href =
                                        "lista-deseos.php";
                                    }, 2000);
                                } else {
                                    swal("Error", "NO se pudo eliminar", "error");
                                }
                            },
                        }); //Fin AJAX
                    } else if (result.dismiss === "cancel") {
                        swal("Cancelado", "Operación cancelada", "error");
                    }
                });


            });


            $(function() {
                $('#zero_config').DataTable({
                    'paging': true,
                    'pageLength': 10,
                    'lengthChange': false,
                    'searching': true,
                    'ordering': true,
                    'info': true,
                    'autoWidth': true,
                    'language': {
                        paginate: {
                            next: 'Siguiente',
                            previous: 'Anterior',
                            last: 'Ultimo',
                            first: 'Primero'
                        },
                        info: 'Mostrando del _START_ al _END_ de _TOTAL_ Articulos',
                        emptyTable: 'Carrito Vacio',
                        infoEmpty: 'Sin Articulos',
                        search: 'Buscar Articulo: '
                    }
                })


            });
        });
    </script>

    </body>

    </html>