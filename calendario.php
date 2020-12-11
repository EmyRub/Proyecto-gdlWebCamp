<?php include_once 'includes/templates/header.php'; ?>   
    <section class="seccion contenedor">
        <h2>Calendario de eventos</h2>

        <?php 
            try {
                require_once('includes/funciones/bd_conexion.php');
                $sql = "SELECT `evento_id`, `nombre_evento`, `fecha_evento`, `hora_evento`, `cat_evento`, `icono`, `nombre_invitado`, `apellido_invitado` "; //Dejar un espacio antes de ""
                $sql .= "FROM `eventos` ";
                $sql .= "INNER JOIN `categoría_evento` "; //Se crea el join, afectan los acentos
                $sql .= "ON eventos.id_cat_evento = categoría_evento.id_categoría "; //Como se va a unir la tabla
                $sql .= "INNER JOIN `invitados` ";
                $sql .= "ON eventos.id_inv = invitados.invitado_id ";
                $sql .= "ORDER BY `evento_id` ";

                $resultado = $conn->query($sql);
            } catch (\Exception $e) {
                $error = $e->getMessage();
            }
        ?>                
          
        <?php
            $calendario = array();
                
            while($eventos = $resultado->fetch_assoc() ) { 

                //Obtiene la fecha del evento
                $fecha = $eventos['fecha_evento'];
                $categoria = $eventos['cat_evento'];

                $evento = array(
                    'titulo' => $eventos['nombre_evento'],
                    'fecha' => $eventos['fecha_evento'],
                    'hora' => $eventos['hora_evento'],
                    'categoria' => $eventos['cat_evento'],
                    'icono' => 'fa' . " " .$eventos['icono'],
                    'invitado' => $eventos['nombre_invitado'] . " " . $eventos['apellido_invitado']
                    );

                $calendario[$fecha][] = $evento; ?>   
        <?php } //while de fetch_assoc ?> 
        
        <div class="calendario clearfix">
            <?php 
                //Imprime todos los eventos
                foreach($calendario as $dia => $lista_eventos) { ?>
                    <div class="clearfix">
                        <h3>
                            <i class="fa fa-calendar"></i>
                            <?php
                                //Unix
                                setlocale(LC_TIME, 'es_ES.UTF-8');
                                //windows
                                setlocale(LC_TIME, 'spanish');

                                echo strftime( "%A %d de %B del %Y ", strtotime($dia) );
                            ?>
                        </h3>                    

                        <?php foreach($lista_eventos as $evento) {?>
                            <div class="dia">
                                <p class="titulo"><?php echo $evento['titulo'];?> </p>

                                <p class="hora"><i class="far fa-clock" aria-hidden="true"></i>
                                    <?php echo $evento['hora']; ?>
                                </p>

                                <p>
                                    <i class="<?php echo $evento['icono']; ?>" aria-hidden="true"></i>
                                    <?php echo $evento['categoria'];?> 
                                </p>

                                <p>                                
                                    <i class="fas fa-user" aria-hidden="true"></i>
                                    <?php echo $evento['invitado']; ?>
                                </p>                                
                            </div> <!--Close day div!-->             
                        <?php } // fin foreach eventos ?>

                    </div>  <!--Close clearfix day !-->
            <?php  } //fin foreach días ?>                       
        </div><!--calendario-->

        <?php
             $conn->close();
        ?> <!--Close query!-->
        
    </section>

    <?php include_once 'includes/templates/footer.php'; ?>

  