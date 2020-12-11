<?php
include_once 'funciones/funciones.php';

$nombre = $_POST['nombre_invitado'];
$apellido = $_POST['apellido_invitado'];
$biografia = $_POST['biografia_invitado'];

$id_registro = $_POST['id_registro'];


if($_POST['registro'] == 'nuevo') {
  /*  $respuesta = array(
        'post' => $_POST,
        'file' => $_FILES
    );
    die(json_encode($respuesta));*/


    // Ubicación donde se van a subir los archivos, 
    //importante dejar una (/) al final
    $directorio = "../img/invitados/"; 

    // is_dir revisa que un directorio exista
    if(!is_dir($directorio) ) {
        //Crea un directorio (permisos, recursivo)
        mkdir($directorio, 0755, true);
    }

    // Mueve los archivos temporales a otra carpeta
    //(ubicación actual), [nuevo directorio]
    if(move_uploaded_file($_FILES['archivo_imagen'] ['tmp_name'], $directorio . $_FILES['archivo_imagen'] ['name'] ) ) {
        $imagen_url = $_FILES['archivo_imagen'] ['name'];
        $imagen_resultado = "Se subió correctamente";
    } else {
        $respuesta = array(
            'respuesta' => error_get_last()
        );
    }
    
    try {      
                
        $stmt = $conn->prepare('INSERT INTO invitados (nombre_invitado, apellido_invitado, descripción, url_imagen) VALUES (?, ?, ?, ?) ');
        $stmt->bind_param("ssss", $nombre, $apellido, $biografia, $imagen_url);
        $stmt->execute();
        $error = $stmt->error;
        $id_insertado = $stmt->insert_id;
       
        if($stmt->affected_rows > 0) {
            $respuesta = array(
                'respuesta' => 'exito',
                'id_insertado' => $id_insertado,
                'resultado_imagen' => $imagen_resultado         
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

    if(!is_dir($directorio) ) {
        //Crea un directorio (permisos, recursivo)
        mkdir($directorio, 0755, true);
    }
    // Mueve los archivos temporales a otra carpeta   
    if(move_uploaded_file($_FILES['archivo_imagen'] ['tmp_name'], $directorio . $_FILES['archivo_imagen'] ['name'] ) ) {
        $imagen_url = $_FILES['archivo_imagen'] ['name'];
        $imagen_resultado = "Se subió correctamente";
    } else {
        $respuesta = array(
            'respuesta' => error_get_last()
        );
    }
    
    try {
        // size > 0; subió algo
        if($_FILES['archivo_imagen']['size'] > 0 ) {
            // Con imagen
            $stmt = $conn->prepare('UPDATE invitados SET nombre_invitado = ?, apellido_invitado = ?, descripción = ?, url_imagen = ? WHERE invitado_id = ?');
            $stmt->bind_param("ssssi", $nombre, $apellido, $biografia, $imagen_url, $id_registro);

        }else {
            // Sin imagen
            $stmt = $conn->prepare('UPDATE invitados SET nombre_invitado = ?, apellido_invitado = ?, descripción = ? WHERE invitado_id = ?');
            $stmt->bind_param("sssi", $nombre, $apellido, $biografia, $id_registro);
        }      
       $estado = $stmt->execute();
       $registros = $stmt->affected_rows;
       $error = $stmt->error;

       if($estado == true) {
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
        $stmt = $conn->prepare('DELETE FROM invitados WHERE invitado_id = ?');
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

