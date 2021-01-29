// Inicializamos jQuery
$(document).ready(function () {
  // Verificamos si tenemos un formulario con el identificador "guardar-registro"
  $("#guardar-registro").on("submit", function (e) {
    // Cancelamos la acción por defecto de hacer clic en un boton submit
    e.preventDefault();
    // Los datos obtenidos los obtenemos en un arreglo
    var datos = $(this).serializeArray();
    //Preparamos la petición AJAX
    $.ajax({
      type: $(this).attr("method"),
      url: $(this).attr("action"),
      data: datos, // Los datos a enviar
      dataType: "json", // Los datos se enviaran en tipo JSON
      // Si la petición se obtuvo
      success: function (data) {
        // La información obtenida de AJAX la almacenamos en una variabñe
        var resultado = data;
        console.log(resultado);
        // Verificamos si la respuesta fue correcta, por eso el arreglo en PHP
        if (resultado.respuesta == "correcto") {
          // Si fue correcto con Sweet alert notificamos la inserción exitosa
          swal("Correcto!", "Proceso Exitoso!!", "success");
          // Redirigimos al index despues de 2 segundos
          setTimeout(function () {
            window.location.href = "index.php";
          }, 2000);
          // En caso de error mandamos un mensaje de que hubo un error
        } else {
          // Notificamos con Sweet Alert
          swal("Info", resultado.respuesta, "info");
          $("#guardar-registro")[0].reset();
        }
      },
    }); // Fin de la petición AJAX
  });

  //Comentarios de Producto
  $("#guardar-comentario").on("submit", function (e) {
    // Cancelamos la acción por defecto de hacer clic en un boton submit
    e.preventDefault();
    // Los datos obtenidos los obtenemos en un arreglo
    var datos = $(this).serializeArray();

    $.ajax({
      type: $(this).attr("method"),
      url: $(this).attr("action"),
      data: datos, // Los datos a enviar
      dataType: "json", // Los datos se enviaran en tipo JSON
      // Si la petición se obtuvo
      success: function (data) {
        // La información obtenida de AJAX la almacenamos en una variabñe
        var resultado = data;
        console.log(resultado);
        // Verificamos si la respuesta fue correcta, por eso el arreglo en PHP
        if (resultado.respuesta == "correcto") {
          // Si fue correcto con Sweet alert notificamos la inserción exitosa
          swal(
            "Correcto!",
            "Tu comentario se ha enviado exitosamente!!",
            "success"
          );
          // Redirigimos al index despues de 2 segundos
          setTimeout(function () {
            window.location.href = "index.php";
          }, 2000);
          // En caso de error mandamos un mensaje de que hubo un error
        } else {
          // Notificamos con Sweet Alert
          swal("Info", resultado.respuesta, "info");
          $("#guardar-registro")[0].reset();
        }
      },
    }); // Fin de la petición AJAX
  });

  $(".borrar_registro").on("click", function (e) {
    e.preventDefault();

    var id = $(this).attr("data-id");
    var tipo = $(this).attr("data-tipo");

    swal({
      title: "Estás Seguro?",
      text: "Esto no se puede deshacer!",
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
            registro: "eliminar",
          },
          url: "includes/models/modelo-ventas.php",
          success: function (data) {
            var resultado = JSON.parse(data);

            if (resultado.respuesta === "correcto") {
              swal(
                "Eliminado",
                "Producto retirado de carrito correctamente",
                "success"
              );
              jQuery('[data-id="' + resultado.id_eliminado + '"]')
                .parents("tr")
                .remove();
              setTimeout(function () {
                window.location.href = "carrito-compras.php";
              }, 2000);
            } else {
              swal("Error", "NO se pudo eliminar", "error");
            }
          },
        }); //Fin AJAX
      } else if (result.dismiss === "cancel") {
        swal("Cancelado", "No se eliminó el registro", "error");
      }
    });
  });
});
