$(document).ready(function() {
    $('.sidebar-menu').tree()

    $('#registros').DataTable({
        'paging': true,
        'pageLength': 10,
        'lengthChange': false,
        'searching': true,
        'ordering': true,
        'info': true,
        'autoWidth': false,
        'language': {
            paginate: {
                next: 'Siguiente',
                previous: 'Anterior',
                last: 'Último',
                first: 'Primero'
            },
            info: "Mostrando _START_a_END_de_TOTAL_resultados",
            emptyTable: 'No hay registros',
            infoEmpty: '0 Resgistros',
            search: 'Buscar'
        }
    });

    $('#crear_registro_admin').attr('disabled', true);

    $('#repetir_password').on('blur', function() {
        var password_nuevo = $('#password').val();

        if ($(this).val() == password_nuevo) {
            $('#resultado_password').text('Correcto');
            $('#resultado_password').parents('.form-group').addClass('has-success').removeClass('has-error');
            $('input#password').parents('.form-group').addClass('has-success').removeClass('has-error');
            $('#crear_registro_admin').attr('disabled', false);
        } else {
            $('#resultado_password').text('La contraseña debe ser igual');
            $('#resultado_password').parents('.form-group').addClass('has-error').removeClass('has-success');
            $('input#password').parents('.form-group').addClass('has-error').removeClass('has-success');
        }
    });

    //Date picker
    $('#fecha').datepicker({
        autoclose: true
    })

    //Initialize Select2 Elements
    $('.seleccionar').select2()

    //Timepicker
    $('.timepicker').timepicker({
        showInputs: false
    })

    //iconpicker
    $('#icono').iconpicker();

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
        checkboxClass: 'icheckbox_minimal-blue',
        radioClass: 'iradio_minimal-blue'
    })

    //Flat red color scheme for iCheck
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
        checkboxClass: 'icheckbox_flat-blue',
        radioClass: 'iradio_flat-blue'
    })

    // LINE CHART
    $.getJSON('servicio-registrado.php', function(data) {
        var line = new Morris.Line({
            element: 'grafica-registros',
            resize: true,
            data: data,
            xkey: 'fecha',
            ykeys: ['cantidad'],
            labels: ['Item 1'],
            lineColors: ['#3c8dbc'],
            hideHover: 'auto'
        });
    });


})