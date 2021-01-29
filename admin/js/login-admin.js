$(document).ready(function () {
   //Login del Administrador
    $('#login-admin').on('submit', function (e) {
        // prevenimos la accion por defecto del submit
        e.preventDefault();
        // almacenamos los datos recibidos por post en una variable
        var datos = $(this).serializeArray();
        $.ajax({
            type: $(this).attr('method'), // el metodo sera POST
            url:  $(this).attr('action'), // el URL el servicio sera login-admin.php
            data: datos,
            dataType: "json",
            // Si la petición fue exitosa
            success: function (data) {
                // almacenamos los datos en una variabke
                var resultado = data;
                console.log(resultado);
                // si la respuesta fue correcta
                if (resultado.respuesta == "correcto") {
                    // mandamos una notificación de bienvenida al usuario 
                    swal('Login correcto', 'Bienvenido '+resultado.usuario+', redirigiendo...', 'success')
                    // y en dos segundos lo redirigimos al Login
                    setTimeout(function(){
                        window.location.href = 'dashboard.php';
                    },2000)
                    // en caso de que la respuesta sea fallida, podemos indicar que el usuario o contraseña es incorrecto
                } else {
                    swal('Error','Usuario y/o contraseña incorrectos!', 'error')
                } 
            }
        });
    });
});