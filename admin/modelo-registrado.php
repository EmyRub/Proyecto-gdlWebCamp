<?php
include_once 'funciones/funciones.php';

$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$email = $_POST['email'];

// Boletos
$boletos_adquiridos = $_POST['boletos'];
// Camisas y Etiquetas
$camisas = $_POST['pedido_extra']['camisas']['cantidad'];
$etiquetas = $_POST['pedido_extra']['etiquetas']['cantidad'];

$pedido = productos_json($boletos_adquiridos, $camisas, $etiquetas);

$total = $_POST['total_pedido'];
$regalo = $_POST['regalo'];

$eventos = $_POST['registro_evento'];
$registro_eventos = eventos_json($eventos);

$fecha_registro = $_POST['fecha_registro'];
$id_registro = $_POST['id_registro'];


if($_POST['registro'] == 'nuevo') {  
    $respuesta = array (
        'nombre' => $nombre,
        'ape' => $apellido,
        'email' => $email,
        'respuesta' => $pedido,
        'total' => $total,
        'regalo' => $regalo,
        'eventos' => $registro_eventos
    );   
   
    try {       
        $stmt = $conn->prepare('INSERT INTO registrados (nombre_registrado, apellido_registrado, email_registrado, fecha_registro, pases_artículos, talleres_registrados, regalo, total_pagado, pagado ) VALUES (?, ?, ?, NOW(), ?, ?, ?, ?, 1) ');
        $stmt->bind_param("sssssis", $nombre, $apellido, $email, $pedido, $registro_eventos, $regalo, $total);
        $stmt->execute();
        $error = $stmt->error;
        $id_insertado = $stmt->insert_id;
       
        if($stmt->affected_rows > 0) {
            $respuesta = array(
                'respuesta' => 'exito',
                'id_insertado' => $id_insertado            
            );
        } else {
            $respuesta = array(
                'respuesta' => 'error',    
                'error' => $error       
            );
        }
        $stmt->close();
        $conn->close();
    }catch(Exception $e) {
        $respuesta = array(
            'respuesta' => $e->getMessage()
        );
    }   
    die(json_encode($respuesta));
}

if($_POST['registro'] == 'actualizar') {      
    try {
       $stmt = $conn->prepare("UPDATE registrados SET nombre_registrado = ?, apellido_registrado = ?, email_registrado = ?, fecha_registro = ?, pases_artículos = ?, talleres_registrados = ?, regalo = ?, total_pagado = ?, pagado = 1 WHERE ID_Registrado = ? ");
       $stmt->bind_param('ssssssisi', $nombre, $apellido, $email, $fecha_registro, $pedido, $registro_eventos, $regalo, $total, $id_registro);
       $stmt->execute();
       $error = $stmt->error;
       if($stmt->affected_rows > 0) {
           $respuesta = array(
               'respuesta' => 'exito',
               'id_actualizado' => $id_registro
           );
       } else {
            $respuesta = array(
                'respuesta' => 'error',
                'error' => $error  
            );
       }
        $stmt->close();
        $conn->close();
    } catch (Exception $e) {
        $respuesta = array (
            'respuesta' => $e->getMessage()        
        );
    }
    die(json_encode($respuesta));
}

if($_POST['registro'] == 'eliminar') {
    
    $id_borrar = $_POST['id'];

    try {
        $stmt = $conn->prepare('DELETE FROM registrados WHERE ID_Registrado = ?');
        $stmt->bind_param('i', $id_borrar);
        $stmt->execute(); // Corre el sql
        $error = $stmt->error;
        if($stmt->affected_rows) {
            $respuesta = array(
                'respuesta' => 'exito',
                'id_eliminado' => $id_borrar
            );
        } else {
            $respuesta = array(
                'respuesta' => 'error',
                'error' => $error  
            );
        }
    } catch(Exception $e) {
        $respuesta = array(
            'respuesta' => $e->getMessage()
        );
    }
    die(json_encode($respuesta));
}


