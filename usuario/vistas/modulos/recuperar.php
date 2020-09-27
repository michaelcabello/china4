<div class="login-box">

  <div class="login-logo">
    <a href="http://www.medic-portal.com"><img src="vistas/img/plantilla/logo.png" class="img-responsive" style="padding:10px 50px;"></a>
  </div>
  <!-- /.login-logoo -->

  <div class="login-box-body">
    
    <p class="login-box-msg">Recuperar Password</p>

    <form  method="post">

      <div class="form-group has-feedback">
        <input type="email" class="form-control" placeholder="Email" id="passEmail" name="passEmail" required>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>

      <div class="row">
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Recuperar</button>
        </div>
        <!-- /.col -->
      </div>

      <?php

          $password = new ControladorUsuarios();
          $password -> ctrOlvidoPassword();

      ?>

    </form>


    <!-- /.social-auth-links -->


    ¿ No tienes una Cuenta ? <a href="registrate" class="text-center"> Registrarte Ahora</a><br>
    <a href="login" class="text-center">Ya tengo una Cuenta</a>


  </div>
  <!-- /.login-box-body -->

</div>
<!-- /.login-box -->
