<footer class="site-footer">
        <div class="contenedor clearfix">
            <div class="footer-informacion">
                <h3>Sobre <span>gdlwebcap</span></h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatem modi quisquam suscipit recusandae cum, minus, dignissimos quidem molestias optio natus debitis odio odit quia ipsam. Omnis rerum officia architecto tempore!</p>
            </div>
            <div class="ultimos-tweets">
                <h3>Últimos <span>Tweets</span></h3>
                <a class="twitter-timeline" data-lang="en" data-height="400" href="https://twitter.com/JuanDevWP?ref_src=twsrc%5Etfw"> 
                    Tweets by JuanDevWP
                </a> 
            </div>
            <div class="menu">
                <h3>Redes <span>Sociales</span></h3>
                <nav class="redes-sociales">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-pinterest-p"></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </nav>
            </div>
        </div>

        <p class="copyright">
            Todos los derechos Reservados GDLWEBCAMP 2020.
        </p>
    </footer>

    <script src="js/vendor/modernizr-3.11.2.min.js"></script> <!--Modernizer!-->
    <script src="js/plugins.js"></script> <!--JavaScript!-->
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
   integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
   crossorigin=""></script> <!--mapa!-->
    <script src="js/jquery-3.5.1.js"></script> <!--jQuery!-->
    <script src="js/jquery-1.12.0.min.js"></script>
    <script src="js/jquery.animateNumber.js"></script>
    <script src="js/jquery.countdown.min.js"></script>
    <script src="js/jquery.lettering.js"></script>
    <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>

    <?php 
        $archivo = basename($_SERVER['PHP_SELF']);
        $pagina = str_replace('.php','', $archivo); //No va a reemplazar nada
        if($pagina == 'invitados' || $pagina =='index') {
            echo '<script src="js/jquery.colorbox.js"></script>';
        } else if($pagina == 'conferencia' ) {
            echo '<script src="js/lightbox.js"></script>';
        }   
   ?>      

    <script src="js/main.js"></script>
    <script src="js/cotizador.js"></script>

    <!-- Google Analytics: change UA-XXXXX-Y to be your site's ID. -->
    <script>
        window.ga = function() {
            ga.q.push(arguments)
        };
        ga.q = [];
        ga.l = +new Date;
        ga('create', 'UA-XXXXX-Y', 'auto');
        ga('set', 'anonymizeIp', true);
        ga('set', 'transport', 'beacon');
        ga('send', 'pageview')
    </script>

    <script src="https://www.google-analytics.com/analytics.js" async></script>

    <script id="mcjs">!function(c,h,i,m,p){m=c.createElement(h),p=c.getElementsByTagName(h)[0],m.async=1,m.src=i,p.parentNode.insertBefore(m,p)}(document,"script","https://chimpstatic.com/mcjs-connected/js/users/3f9d581cff940f98f1692f245/a455dc3a09b50df9f25132db4.js");</script> <!--link de mailchimp!-->

  
</body>

</html>