<?php

    $host = "localhost";
    $username = "root";
    $password = "root";
    $db = "gdlwebcamp";
    $port = "8889";


    //Create connection: servername; username; password;
    $conn = new mysqli($host, $username, $password, $db, $port);
    
    //Check connection
    if($conn->connect_error){
        echo $error = $conn->connect_error;
    }
?>