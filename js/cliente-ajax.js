$(document).ready(function () {
    // Creacion de Usuario
    $('#generar-registro').on('submit', function (e) {

        e.preventDefault();
        
        var datos = $(this).serializeArray();


        $.ajax({
            type: $(this).attr('method'),
            url:  $(this).attr('action'),
            data: datos,
            dataType: "json",
            success: function (data) {
                var resultado = data;
                console.log(resultado);
                if (resultado.respuesta == "correcto") {
                    swal('Correcto!', 'El registro se realizo exitosamente!', 'success')
                    setTimeout(function(){
                        window.location.href = 'inicio-sesion.php';
                    },2000)
                } else {
                    swal('Error','Ocurrio un error!', 'error')
                } 
            }
        });
    });


    //Login del Administrador
    $('#login-admin').on('submit', function (e) {

    e.preventDefault();

    var datos = $(this).serializeArray();
    console.log(datos);

    $.ajax({
        type: $(this).attr('method'),
        url:  $(this).attr('action'),
        data: datos,
        dataType: "json",
        success: function (data) {
            var resultado = data;
            console.log(resultado);
            if (resultado.respuesta == "correcto") {
                swal('Login correcto', 'Bienvenido '+resultado.usuario+', redirigiendo...', 'success')
                setTimeout(function(){
                    window.location.href = 'index.php';
                },2000)
            } else {
                swal('Error','Usuario y/o contraseña incorrectos!', 'error')
            } 
        }
    });
    });

    // Edicion de Perfil
    $('#editar-perfil').on('submit', function (e) {

        e.preventDefault();
        
        var datos = new FormData(this);

        $.ajax({
            type: $(this).attr('method'),
            url:  $(this).attr('action'),
            data: datos,
            dataType: "json",
            contentType: false,
            processData: false,
            async: true,
            cache: false,
            success: function (data) {
                var resultado = data;
                console.log(resultado);
                if (resultado.respuesta == "correcto") {
                    swal('Correcto!', 'Se ha actualizado el registro', 'success')
                    setTimeout(function(){
                        window.location.href = 'index.php';
                    },2000)
                } else {
                    swal('Error','Ocurrio un error!', 'error')
                } 
            }
        });
    });


});
