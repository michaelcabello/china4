<?php

require_once "../controladores/usuarios.controlador.php";
require_once "../modelos/usuarios.modelo.php";

class AjaxUsuarios{

  /*=============================================
  ACTIVAR USUARIOS
  =============================================*/	

  public $activarUsuario;
  public $activarId;

  public function ajaxActivarUsuario(){

  	$respuesta = ModeloUsuarios::mdlActualizarUsuario("usuarios", "verificacion", $this->activarUsuario, "id", $this->activarId);

  	echo $respuesta;

  }


  /*=============================================
  VALIDAR EMAIL EXISTENTEE
  =============================================*/ 

  public $validarEmail;

  public function ajaxValidarEmail(){

    $datos = $this->validarEmail;

    $respuesta = ControladorUsuarios::ctrMostrarUsuario("email", $datos);

    echo json_encode($respuesta);

  }


}//FIN DE LA CLASE

/*=============================================
ACTIVAR CATEGORIA
=============================================*/

if(isset($_POST["activarUsuario"])){

	$activarUsuario = new AjaxUsuarios();
	$activarUsuario -> activarUsuario = $_POST["activarUsuario"];
	$activarUsuario -> activarId = $_POST["activarId"];
	$activarUsuario -> ajaxActivarUsuario();

}

/*=============================================
VALIDAR EMAIL EXISTENTE
=============================================*/ 

if(isset($_POST["validarEmail"])){

  $valEmail = new AjaxUsuarios();
  $valEmail -> validarEmail = $_POST["validarEmail"];
  $valEmail -> ajaxValidarEmail();

}