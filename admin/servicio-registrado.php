<?php 
  include_once 'funciones/sesiones.php';
  include_once 'funciones/funciones.php';
 
  $sql = "SELECT DATE(fecha_registro) AS fecha, COUNT(*) AS resultado FROM registrados GROUP BY DATE(fecha_registro) ORDER BY DATE(fecha_registro) ";
  $resultado = $conn->query($sql);

  $arreglo_registros = array();
  while($registro_dia = $resultado->fetch_assoc() ) {
      $fecha = $registro_dia['fecha'];
      $registro['fecha'] = date('Y-m-d', strtotime($fecha));
      $registro['cantidad'] = $registro_dia['resultado'];

      $arreglo_registros[] = $registro;
  }

  
  echo (json_encode($arreglo_registros));
  
