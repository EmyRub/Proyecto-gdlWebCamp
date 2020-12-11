<?php



define('URL_SITIO', 'http://localhost:8888/gdlWebcamp_server');

include_once 'paypal/autoload.php';

//Entra a la clase
$apiContext = new \PayPal\Rest\ApiContext (
    new \PayPal\Auth\OAuthTokenCredential (    
        
        // Instala las dos appis
        'AeDMKJvr0ZLJA8OCKwccVlo6TxOMsdME4q0dGNZp4foBsds3knnLd7Gd3T6EvUg4AsoxqgqYi5rzrgom', // ClienteID
        'EDdeEJErf8uwB6WVUC-2P3emcrzEReC2JpspvzzcjMBMV6dO6L6htZJCxJlMP4Bmhi8LZXYOvjX78Tpn'  // Secret
       
    )
);

