(function() {
    'use strict';

    document.addEventListener('DOMContentLoaded', function() {

        //Mapa
        if (document.getElementById('mapa')) {
            var map = L.map('mapa').setView([18.921551, -99.234695], 13);
            //('mapa')= id de contenedor; setView & .marker (localizacion en el mapa coords); 13= nivel de zoom

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            L.marker([18.921551, -99.234695]).addTo(map)
                .bindPopup('GDLWebCamp 2020 <br> Boletos ya disponibles')
                .openPopup()
                .bindTooltip('Un Tooltip')
                .openTooltip();
        }

    }); // DOM CONTENT LOADED

    $(function() {

        // Lettering
        $('.nombre-sitio').lettering();

        //Agregar clase a menú
        $('body.conferencia .navegacion-principal a:contains("Conferencias")').addClass('activo');
        $('body.calendario .navegacion-principal a:contains("Calendario")').addClass('activo');
        $('body.invitados .navegacion-principal a:contains("Invitados")').addClass('activo');

        //Menu Fijo
        var windowHeight = $(window).height();
        var barraAltura = $('.barra').innerHeight();

        console.log(barraAltura);

        $(window).scroll(function() {
            var scroll = $(window).scrollTop();
            if (scroll > windowHeight) {
                $('.barra').addClass('fixed');
                $('body').css({ "margin-top": barraAltura + "px" });
            } else {
                $('.barra').removeClass('fixed');
                $('body').css({ 'margin-top': '0px' });
            }
        });

        // Menu Responsivo
        $('.menu-movil').on('click', function() {
            $('.navegacion-principal').slideToggle();
        });

        //Programa de Conferencias
        $('.programa-evento .info-curso:first').show();
        $('.menu-programa a:first').addClass('activo');


        $('.menu-programa a').on('click', function() {
            $('.menu-programa a').removeClass('activo');
            $(this).addClass('activo');
            $('.ocultar').hide();

            var enlace = $(this).attr('href');
            $(enlace).fadeIn(1000);

            return false;
        });

        //Animaciones para los números
        $('.resumen-evento li:nth-child(1) p').animateNumber({ number: 6 }, 1200);
        $('.resumen-evento li:nth-child(2) p').animateNumber({ number: 15 }, 1200);
        $('.resumen-evento li:nth-child(3) p').animateNumber({ number: 3 }, 1500);
        $('.resumen-evento li:nth-child(4) p').animateNumber({ number: 9 }, 1500);


        //Cuenta Regresiva
        $('.cuenta-regresiva').countdown('2021/09/10 09:00:00', function(event) {
            $('#dias').html(event.strftime('%D'));
            $('#horas').html(event.strftime('%H'));
            $('#minutos').html(event.strftime('%M'));
            $('#segundos').html(event.strftime('%S'));
        });

        // Colorbox

        $('.invitado-info').colorbox({ inline: true, width: "50%" });

    });

})();