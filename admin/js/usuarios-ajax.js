/**
 * @description: Este archivo tiene el tratamiento de los usuarios en el sistema entre elllos
 * la auteticación y su CRUD mediante AJAX
 * @author: Ray Garcia Gonzalez
 */

$(document).ready(function () {    
    // Insertar o Editar
        // Funcion que se ejecuta cuando tratamos formularios con imagenes -- Insertar o Editar
    $('#guardar-registro-imagen').on('submit', function (e) {
        // Prevenimos la accion por defecto del submit
        e.preventDefault();
        // almacenamos los datos obtenidos del form en una variable
        var datos = new FormData(this);
        // inicio de la peticionA JAX
        $.ajax({
            type: $(this).attr('method'), // Llamamos al tipo de peticion alojada en el form
            url:  $(this).attr('action'), // Llamamos al servicio que establecimos en el form
            data: datos, // tomamos los datos del formulario
            dataType: "json", // el tipo de datos recibidos seran tipo JSON
            contentType: false, // el resto de las instrucciones nos permiten subir imagenes al servidor
            processData: false,
            async: true,
            cache: false,
            // si la petición fue exitosa
            success: function (data) {
                var resultado = data;
                console.log(resultado);
                // y la respuesta obtenida fue correcta
                if (resultado.respuesta == "correcto") {
                    //Mandamos una notificacion con SweetAlert2 
                    swal('Correcto!', 'Se ha insertado el registro exitosamente', 'success')
                    // y despues de 2 seg redirigimos al dashboard del sistema
                    setTimeout(function(){
                        window.location.href = 'dashboard.php';
                    },2000)
                    // en caso de error mandammos una notificacion indicando que hubo un error
                } else {
                    swal('Error','Ocurrio un error!', 'error')
                } 
            }
        }); // Fin de peticion AJAX
    });

    // Insertar o Editar
    $('#guardar-registro').on('submit', function (e) {

        e.preventDefault();
        
        var datos = $(this).serializeArray();

        $.ajax({
            type: $(this).attr('method'),
            url:  $(this).attr('action'),
            data: datos,
            dataType: "json",
            success: function (data) {
                var resultado = data;
                if (resultado.respuesta == "correcto") {
                    swal('Correcto!', 'Se ha efectuado la operación exitosamente', 'success')
                    setTimeout(function(){
                        window.location.href = 'dashboard.php';
                    },2000)
                } else {
                    swal('Error','Ocurrio un error!', 'error')
                } 
            }
        });
    });
   
    // Eliminación de un registro
   $('.borrar_registro').on('click', function(e){
    // cancelamos la accion por defecto del submit    
    e.preventDefault();
    // tomamos el id del registro 
    var id = $(this).attr('data-id');
    // para reutilizar este codigo para cualquier otra tabla, creamos una variable que traiga el tipo de modelo o tabla a afectar
    var tipo = $(this).attr('data-tipo'); 

    // inicializamos una notificación mediante SweetAlert2
    swal({
        title: 'Estás Seguro?', // titulo de la notificacion
        text: "Esto no se puede deshacer!", // Texto principal de la notificacion
        type: 'warning', // tipo de notificacion
        showCancelButton: true, // que sea cancelable
        confirmButtonColor: '#3085d6', // establecemos un color al boton de confirmación
        cancelButtonColor: '#d33',// y uno para el boton cancelar
        confirmButtonText: 'Si, borrar!!', // texto del boton confirmar
        cancelButtonText: 'No, Cancelar', // texto del boton cancelar
        confirmButtonClass: 'btn btn-success', // traemos los atributos de bootstrap a los botones mediante sus clases
        cancelButtonClass: 'btn btn-danger'
      }).then((result) => { // Creamos una Promesa que detecte la respuesta seleccionada en la notificacion 
        // Si le dimos clic al boton confirmar
        if (result.value) {
            $.ajax({ // inicalizamos AJAX
                type: 'POST', // el tipo sera mediante POST
                data: { 
                    // Los datos serian el id y la respuesta de la eliminacipn
                    'id': id,
                    'registro': 'eliminar'
                },
                // La ubicación del service sera el tipo de modelo (Puede ser usuario, producto, etc)
                url: 'includes/models/modelo-'+ tipo + '.php',
                // procesamos los datos si la peticion es exitosa
                success: function(data){
                    var resultado = JSON.parse(data); 
                    // si la respuesta da como resultado correcto
                    if(resultado.respuesta === 'correcto'){
                        // con SweetAlert2 notificamos que el resgistro se elimino
                        swal("Eliminado", "Registro eliminado", "success");
                        // con JQuery manipulamos el DOM y retiramos de la tabla el registro eliminado
                        jQuery('[data-id="'+ resultado.id_eliminado +'"]').parents('tr').remove();
                    } else { // en caso contrario
                        // notificamos que no se pudo eliminar el registro
                        swal("Error", "NO se pudo eliminar", "error");
                    }
                }
            }); //Fin AJAX
            // en caso de haber seleccionado el boton cancelar
        } else if (result.dismiss === 'cancel') {
            // notificamos que se cancelo la operación
          swal(
            'Cancelado',
            'No se eliminó el registro',
            'error'
          )
        }

    });
   
    });
   
   
});


