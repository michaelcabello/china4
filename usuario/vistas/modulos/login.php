<script src='https://www.google.com/recaptcha/api.js'></script>

<div class="login-box">

  <div class="login-logo">
    <a href="http://www.medic-portal.com"><img src="vistas/img/plantilla/logo.png" class="img-responsive" style="padding:10px 50px;"></a>
  </div>
  <!-- /.login-logoo -->

  <div class="login-box-body">
    
    <p class="login-box-msg">Ingresar al sistema</p>

    <form  method="post">

      <div class="form-group has-feedback">
        <input type="email" class="form-control" placeholder="Email" name="ingEmail" required>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>

      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" name="ingPassword" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>

      <center>
          
          <div class="g-recaptcha" data-sitekey="6Lc_psoZAAAAAKiQVx7kzf_taGvjlQ-OQQq6qAOK"></div>

      </center>

      <div class="row">
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Ingresar</button>
        </div>
        <!-- /.col -->
      </div>

      <?php

        $login = new ControladorUsuarios();
        $login -> ctrIngresoUsuario();

      ?>

    </form>
    <!--
    <div class="social-auth-links text-center">
      <p>- O -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Ingresar Usando Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Ingresar Usando Google+</a>
    </div>
    -->
    <!-- /.social-auth-links -->

    <a href="recuperar">Recordar mi Contraseña</a><br>
    <a href="registrate" class="text-center">Registrarme Ahora</a>


  </div>
  <!-- /.login-box-body -->

</div>
<!-- /.login-box -->
