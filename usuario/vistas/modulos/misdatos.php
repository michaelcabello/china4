

<?php

//$configuraciones = ControladorConfiguraciones::ctrSeleccionarConfiguracion();

?>  

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <!-- Content Wrapper. Contains page contentt -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
      <section class="content-header">
          <h1>
            Configuraciones
            <small>Preview</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="inicio"><i class="fa fa-dashboard"></i> inicio</a></li>
            <li class="active">Configuraciones</li>
          </ol>
      </section>

      <!-- Main content -->
      <section class="content">
            <div class="row">

              <!-- primera columna -->
                  <div class="col-md-6">
                   <?php

                      /*=============================================
                      ADMINISTRACIÓN DE LOGOTIPO E ICONO
                      =============================================*/

                     // include "configuraciones/logoeicono.php";

                      /*=============================================
                      ADMINISTRACIÓN DE TELEFONO
                      =============================================*/

                      include "misdatos/telefonos.php";


                      /*=============================================
                      ADMINISTRACIÓN DE CORREO Y REDES
                      =============================================*/

                      //include "configuraciones/correoyredes.php";

                    ?>

                  </div><!-- fin de la primera columna -->
              
       
              <!--  segunda columna derecha -->

                  <div class="col-md-6">
                    <!-- Horizontal Form -->

                     <?php

                      /*=============================================
                      ANALITICA WEB
                      =============================================*/

                     // include "configuraciones/analiticaweb.php";
                    //  include "configuraciones/slogandireccion.php";
                    //  include "configuraciones/numeros.php";

                     ?>

                  </div> <!--  fin de la columana derecha -->

            </div>
            <!-- /.row -->
      </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


</div>

