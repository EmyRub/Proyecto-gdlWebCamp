<?php
include_once 'funciones/funciones.php';

$nombre_categoria = $_POST['nombre_categoria'];
$icono = $_POST['icono'];

$id_registro = $_POST['id_registro'];

if($_POST['registro'] == 'nuevo') {    
    try {       
                
        $stmt = $conn->prepare('INSERT INTO categoría_evento (cat_evento, icono) VALUES (?, ?) ');
        $stmt->bind_param("ss", $nombre_categoria, $icono);
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
       $stmt = $conn->prepare("UPDATE categoría_evento SET cat_evento = ?, icono = ?, editado = NOW() WHERE id_categoría = ? ");
       $stmt->bind_param('ssi', $nombre_categoria, $icono, $id_registro);
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
        $stmt = $conn->prepare('DELETE FROM categoría_evento WHERE id_categoría = ?');
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


