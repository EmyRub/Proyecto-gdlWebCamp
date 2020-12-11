<?php 
  //Antes de todo: redirección
  include_once 'funciones/sesiones.php';

  include_once 'funciones/funciones.php';
  include_once 'templates/header.php';
  include_once 'templates/barra.php';
  include_once 'templates/navegacion.php';

?> 

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Información Sobre el Evento</small>
      </h1>     
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
             <!-- LINE CHART -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Line Chart</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body chart-responsive">
              <div class="chart" id="grafica-registros" style="height: 300px;"></div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>

        <h2 class="page-header">Resumen de Registros</h2>
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <?php 
                    $sql = "SELECT COUNT(ID_Registrado) AS registros FROM registrados ";
                    $resultado = $conn->query($sql);
                    $registrados = $resultado->fetch_assoc();
                
                ?>
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                    <h3><?php echo $registrados['registros'];  ?></h3>
                    <p>Total Registrados</p>
                    </div>
                    <div class="icon">
                    <i class="fa fa-user"></i>
                    </div>
                    <a href="lista-registrados.php" class="small-box-footer">
                    Más Información <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div> <!-- ./col -->   

            <div class="col-lg-3 col-xs-6">
                <?php 
                    $sql = "SELECT COUNT(ID_Registrado) AS registros FROM registrados WHERE pagado = 1 ";
                    $resultado = $conn->query($sql);
                    $registrados = $resultado->fetch_assoc();
                
                ?>
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                    <h3><?php echo $registrados['registros'];  ?></h3>

                    <p>Total Pagados</p>
                    </div>
                    <div class="icon">
                    <i class="fa fa-users"></i>
                    </div>
                    <a href="lista-registrados.php" class="small-box-footer">
                    Más Información <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div> <!-- ./col -->   

            <div class="col-lg-3 col-xs-6">
                <?php 
                    $sql = "SELECT COUNT(ID_Registrado) AS registros FROM registrados WHERE pagado = 0 ";
                    $resultado = $conn->query($sql);
                    $registrados = $resultado->fetch_assoc();
                
                ?>
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                    <h3><?php echo $registrados['registros'];  ?></h3>
                    <p>Total sin Pagar</p>
                    </div>
                    <div class="icon">
                    <i class="fa fa-user-times"></i>
                    </div>
                    <a href="lista-registrados.php" class="small-box-footer">
                    Más Información <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div> <!-- ./col -->  
            
            <div class="col-lg-3 col-xs-6">
                <?php 
                    $sql = "SELECT SUM(total_pagado) AS ganancias FROM registrados WHERE pagado = 1 ";
                    $resultado = $conn->query($sql);
                    $registrados = $resultado->fetch_assoc();
                
                ?>
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                    <h3>$<?php echo (float) $registrados['ganancias'];  ?></h3>

                    <p>Ganancias Totales</p>
                    </div>
                    <div class="icon">
                    <i class="fas fa-dollar-sign"></i>
                    </div>
                    <a href="lista-registrados.php" class="small-box-footer">
                    Más Información <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div> <!-- ./col -->             
        </div> <!-- ./row Usuarios -->   

        <h2 class="page-header">Camisas y Etiquetas (Pedidos Extra)</h2>
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <?php 
                        $sql = "SELECT pases_artículos FROM registrados WHERE pagado = 1 ";
                        $resultado = $conn->query($sql);
                        $etiquetas = 0;
                        while(  $registrados = $resultado->fetch_assoc() ) {
                            $datos = $registrados['pases_artículos'];
                            $objResultado = json_decode($datos, true);
                            if(isset($objResultado['etiquetas']) ) {
                                $etiquetas += $objResultado['etiquetas'];
                            }
                        }                  
                    ?>
                <!-- small box -->
                <div class="small-box bg-maroon">
                    <div class="inner">
                        <h3><? echo $etiquetas; ?></h3>

                        <p>Etiquetas</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-tags"></i>
                    </div>
                    <a href="lista-registrados.php" class="small-box-footer">
                    Más Información <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div> <!-- ./col Etiquetas--> 
            
            <div class="col-lg-3 col-xs-6">
                <?php 
                    $sql = "SELECT pases_artículos FROM registrados WHERE pagado = 1 ";
                    $resultado = $conn->query($sql);
                    $camisas = 0;
                    while(  $registrados = $resultado->fetch_assoc() ) {
                        $datos = $registrados['pases_artículos'];
                        $objResultado = json_decode($datos, true);
                        if(isset($objResultado['camisas']) ) {
                            $camisas += $objResultado['camisas'];
                        }
                    }                  
                ?>
                <!-- small box -->
                <div class="small-box bg-fuchsia-active">
                    <div class="inner">
                        <h3><?php echo $camisas;  ?></h3>

                        <p>Camisas</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-tshirt"></i>
                    </div>
                    <a href="lista-registrados.php" class="small-box-footer">
                    Más Información <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div> <!-- ./col Camisas -->  

        </div> <!-- /Row Pedidos Extra -->

        <h2 class="page-header">Regalos</h2>
        <div class="row">

            <div class="col-lg-3 col-xs-6">
                <?php 
                    $sql = "SELECT COUNT(ID_Registrado) AS pulseras FROM registrados WHERE pagado = 1 AND regalo = 1 ";                    
                    $resultado = $conn->query($sql);
                    $pulseras = $resultado->fetch_assoc();                    
                ?>
                <!-- small box -->
                <div class="small-box bg-teal">
                    <div class="inner">
                        <h3><?php echo $pulseras['pulseras'];  ?></h3>

                        <p>Pulseras</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-ring"></i>
                    </div>
                    <a href="lista-registrados.php" class="small-box-footer">
                    Más Información <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div> <!-- ./col Pulseras-->            

            <div class="col-lg-3 col-xs-6">
                <?php 
                    $sql = "SELECT COUNT(ID_Registrado) AS etiquetas FROM registrados WHERE pagado = 1 AND regalo = 2 ";                    
                    $resultado = $conn->query($sql);
                    $etiquetas = $resultado->fetch_assoc();             
                ?>
                <!-- small box -->
                <div class="small-box bg-orange-active">
                    <div class="inner">
                        <h3><?php echo $etiquetas['etiquetas'];  ?></h3>

                        <p>Etiquetas</p>
                    </div>
                    <div class="icon">
                         <i class="fas fa-tags"></i>
                    </div>
                    <a href="lista-registrados.php" class="small-box-footer">
                    Más Información <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div> <!-- ./col Etiquetas --> 
            
            <div class="col-lg-3 col-xs-6">
                <?php 
                    $sql = "SELECT COUNT(ID_Registrado) AS plumas FROM registrados WHERE pagado = 1 AND regalo = 3 ";                    
                    $resultado = $conn->query($sql);
                    $plumas = $resultado->fetch_assoc();             
                ?>
                <!-- small box -->
                <div class="small-box bg-purple-active">
                    <div class="inner">
                        <h3><?php echo $plumas['plumas'];  ?></h3>

                        <p>Plumas</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-pen"></i>
                    </div>
                    <a href="lista-registrados.php" class="small-box-footer">
                    Más Información <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div> <!-- ./col Plumas -->  

        </div> <!-- ./row Regalos -->  
        
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php include_once 'templates/footer.php'; ?>
 

