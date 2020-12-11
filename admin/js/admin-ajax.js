$(document).ready(function() {

    $('#guardar-registro').on('submit', function(e) {
        e.preventDefault();

        var datos = $(this).serializeArray();

        // Crear llamado en Ajax
        $.ajax({
            type: $(this).attr('method'), //Tipo de request (type)
            data: datos, // Datos mandados por serialize
            url: $(this).attr('action'),
            dataType: 'json',
            success: function(data) {
                console.log(data);
                var resultado = data;
                if (resultado.respuesta == 'exito') {
                    swal.fire(
                        'Correcto',
                        'Se guardó correctamente',
                        'success'
                    )
                } else {
                    Swal.fire(
                        'Error',
                        'Hubo un error',
                        'error'
                    )
                }
            }
        });
    });

    // Se ejecuta cuando hay un archivo
    $('#guardar-registro-archivo').on('submit', function(e) {
        e.preventDefault();

        var datos = new FormData(this);

        // Crear llamado en Ajax
        $.ajax({
            type: $(this).attr('method'), //Tipo de request (type)
            data: datos,
            url: $(this).attr('action'),
            dataType: 'json',
            contentType: false,
            processData: false,
            async: true,
            cache: false,
            success: function(data) {
                console.log(data);
                var resultado = data;
                if (resultado.respuesta == 'exito') {
                    swal.fire(
                        'Correcto',
                        'Se guardó correctamente',
                        'success'
                    )
                } else {
                    Swal.fire(
                        'Error',
                        'Hubo un error',
                        'error'
                    )
                }
            }
        });
    });

    // Eliminar un registro
    $('.borrar_registro').on('click', function(e) {
        e.preventDefault();

        var id = $(this).attr('data-id');
        var tipo = $(this).attr('data-tipo');

        Swal.fire({
            title: '¿Estás Segur@?',
            text: "La acción es permanente",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtontext: 'Sí, eliminalo!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'post',
                    data: {
                        'id': id,
                        'registro': 'eliminar'
                    },
                    url: 'modelo-' + tipo + '.php',
                    success: function(data) {
                        console.log(data);
                        var resultado = JSON.parse(data);
                        if (resultado.respuesta == 'exito') {
                            swal.fire(
                                'Eliminado',
                                'Registro Eliminado',
                                'success'
                            )
                            jQuery('[data-id="' + resultado.id_eliminado + '"]').parents('tr').remove();
                        } else {
                            swal.fire(
                                'Error',
                                'No se pudo eliminar',
                                'error'
                            )
                        } // End else
                    }
                })
            }

        });
    });
});