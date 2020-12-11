<?php
include_once 'funciones/funciones.php';

$titulo = $_POST['titulo_evento'];
$categoria_id = $_POST['categoria_evento'];
$invitado_id = $_POST['invitado'];
// obtener la fecha
$fecha = $_POST['fecha_evento'];
$fecha_formateada = date("Y-m-d", strtotime($fecha));
// Hora
$hora = $_POST['hora_evento'];
$hora_formateada = date('H:i:s', strtotime($hora));

$id_registro = $_POST['id_registro'];


// Registro de Claves
if($categoria_id == 1 ) {
    $clave = 'Sem_00';
} elseif ($categoria_id == 2) {
    $clave = 'Conf_00';
} else {
    $clave = 'Taller_00';
}



if($_POST['registro'] == 'nuevo') {

    try {        
        $stmt = $conn->prepare("INSERT INTO eventos (nombre_evento, fecha_evento, hora_evento, id_inv, id_cat_evento, clave) VALUES (?, ?, ?, ?, ?, ?) ");
        $stmt->bind_param("sssiis", $titulo, $fecha_formateada, $hora_formateada, $invitado_id, $categoria_id, $clave);
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
       $stmt = $conn->prepare("UPDATE eventos SET nombre_evento = ?, fecha_evento = ?, hora_evento = ?, id_inv = ?, id_cat_evento = ?, clave = ?, editado = NOW()  WHERE evento_id = ? ");
       $stmt->bind_param('sssiisi', $titulo, $fecha_formateada, $hora_formateada, $invitado_id, $categoria_id, $clave, $id_registro);
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
        $stmt = $conn->prepare('DELETE FROM eventos WHERE evento_id = ?');
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


