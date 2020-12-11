$(document).ready(function() {
    $('#login-admin').on('submit', function(e) {
        e.preventDefault();

        var datos = $(this).serializeArray();

        // Crear llamado en Ajax
        $.ajax({
            type: $(this).attr('method'), //Tipo de request (type)
            data: datos, // Datos mandados por serialize
            url: $(this).attr('action'),
            dataType: 'json',
            success: function(data) {
                //console.log(data);
                var resultado = data;
                if (resultado.respuesta == 'exitoso') {
                    swal.fire(
                        'Login Correcto',
                        'Bienvenid@: ' + resultado.usuario + '!!',
                        'success'
                    )
                    setTimeout(function() {
                        window.location.href = 'admin-area.php';
                    }, 2000);
                } else {
                    Swal.fire(
                        'Error',
                        'Usuario o Password incorrectos',
                        'error'
                    )
                }
            }
        });
    });
});