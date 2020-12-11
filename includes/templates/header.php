<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta property="og:title" content="">
    <meta property="og:type" content="">
    <meta property="og:url" content="">
    <meta property="og:image" content="">
     <meta name="theme-color" content="#fafafa">

    <link rel="manifest" href="site.webmanifest">
    <link rel="apple-touch-icon" href="icon.png">
    <!-- Place favicon.ico in the root directory -->

    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css" integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&family=Oswald:wght@300&family=PT+Sans&display=swap" rel="stylesheet">
    

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
   integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
   crossorigin=""/>
   
   <?php 
        $archivo = basename($_SERVER['PHP_SELF']);
        $pagina = str_replace('.php','', $archivo); //No va a reemplazar nada

        if($pagina == 'invitados' || $pagina =='index') {
            echo '<link rel="stylesheet" href="css/colorbox.css">';

        } else if($pagina == 'conferencia' ) {
            echo ' <link rel="stylesheet" href="css/lightbox.css">';
        }   
   ?> 
    
    <link rel="stylesheet" href="css/main.css">
   
</head>


<body class="<?php echo $pagina; ?>">

    <!-- Add your site or application content here -->

    <header class="site-header">
        <div class="hero">
            <div class="contenido-header">
                <nav class="redes-sociales">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-pinterest-p"></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </nav>
                <div class="informacion-evento">
                    <div class="clearfix">
                        <p class="fecha"><i class="fas fa-calendar-alt"></i>10-12 Dic</p>
                        <p class="ciudad"><i class="fas fa-map-marker-alt"></i>Guadalajara, MX</p>
                    </div>

                    <h1 class="nombre-sitio ">GdlWebCamp</h1>
                    <p class="slogan">La mejor conferencia de <span>diseño web</span></p>
                </div>
                <!--información-evento-->

            </div>
        </div>
        <!--hero-->
    </header>

    <div class="barra">
        <div class="contenedor clearfix">
            <div class="logo">
                <a href="index.php">
                    <img src="img/logo.svg" alt="logo gdlwebcamp">
                </a>
            </div>

            <div class="menu-movil">
                <span></span>
                <span></span>
                <span></span>
            </div>

            <nav class="navegacion-principal clearfix">
                <a href="conferencia.php">Conferencias</a>
                <a href="calendario.php">Calendario</a>
                <a href="invitados.php">Invitados</a>
                <a href="registro.php">Reservaciones</a>
            </nav>
        </div>
        <!--Contenedor-->
    </div>
    <!--Barra-->

