<?php

class ControladorUsuarios{

	/*=============================================
	REGISTRO DE USUARIO
	=============================================*/

	public function ctrRegistroUsuario(){

		if(isset($_POST["regUsuario"])){

			$key = "6Lc_psoZAAAAAOe3UGE_S9bICY2qZIOvm3zFiLJK";
			$respuesta = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$key."&response=".$_POST['g-recaptcha-response']);
			$respuestac = json_decode($respuesta, true);
			if($respuestac['success'] == true){

				if(preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["regUsuario"]) &&
				   preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["regEmail"]) &&
				   preg_match('/^[a-zA-Z0-9]+$/', $_POST["regPassword"])){

				   	$encriptar = crypt($_POST["regPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$
				   		$2a$07$asxx54ahjppf45sd87a5auxq/SS293XhTEeizKWMnfhnpfay0AALe');

				   	$encriptarEmail = md5($_POST["regEmail"]);

					$datos = array("nombre"=>$_POST["regUsuario"],
								   "password"=> $encriptar,
								   "email"=> $_POST["regEmail"],
								   "foto"=>"",
								   "modo"=> "directo",
								   "verificacion"=> 0,
								   "estado"=> 1,
								   "emailEncriptado"=>$encriptarEmail);

					$tabla = "profesionales";

					$respuesta = ModeloUsuarios::mdlRegistroUsuario($tabla, $datos);

				    if($respuesta == "ok"){

						/*=============================================
						ACTUALIZAR f NOTIFICACIONES NUEVOS USUARIOS
						=============================================*/

						//$traerNotificaciones = ControladorNotificaciones::ctrMostrarNotificaciones();

						//$nuevoUsuario = $traerNotificaciones["nuevosUsuarios"] + 1;

						//ModeloNotificaciones::mdlActualizarNotificaciones("notificaciones", "nuevosUsuarios", $nuevoUsuario);

						/*=============================================
						VERIFICACIÓN CORREO ELECTRÓNICO
						=============================================*/

						date_default_timezone_set("America/Lima");

						$url = Ruta::ctrRuta();	

						$mail = new PHPMailer;

						$mail->CharSet = 'UTF-8';

						$mail->isMail();

						$mail->setFrom('registro@medic-portal.com', 'MEDIC PORTAL');

						$mail->addReplyTo('registro@medic-portal.com', 'MEDIC PORTAL');

						$mail->Subject = "Por favor verifique su dirección de correo electrónico";

						$mail->addAddress($_POST["regEmail"]);

						$mail->msgHTML('<div style="width:100%; background:#eee; position:relative; font-family:sans-serif; padding-bottom:40px">
							
							<center>
								
								<img style="padding:20px; width:10%" src="http://www.medic-portal.com/usuario/vistas/img/medicportal.jpg">

							</center>

							<div style="position:relative; margin:auto; width:600px; background:white; padding:20px">
							
								<center>
								
								<img style="padding:20px; width:15%" src="http://www.medic-portal.com/usuario/vistas/img/icon-email.png">

								<h3 style="font-weight:100; color:#999">VERIFIQUE SU DIRECCIÓN DE CORREO ELECTRÓNICO</h3>

								<hr style="border:1px solid #ccc; width:80%">

								<h4 style="font-weight:100; color:#999; padding:0 20px">Para comenzar a usar su cuenta de Tienda Virtual, debe confirmar su dirección de correo electrónico</h4>

								<a href="www.medic-portal.com/verificar/'.$encriptarEmail.'" target="_blank" style="text-decoration:none">

								<div style="line-height:60px; background:#0aa; width:60%; color:white">Verifique su dirección de correo electrónico</div>

								</a>

								<br>

								<hr style="border:1px solid #ccc; width:80%">

								<h5 style="font-weight:100; color:#999">Si no se inscribió en esta cuenta, puede ignorar este correo electrónico y la cuenta se eliminará.</h5>

								</center>

							</div>

						</div>');

						$envio = $mail->Send();
						//var_dump($envio);

						if(!$envio){

							echo '<script> 

								swal({
									  title: "¡ERROR!",
									  text: "¡Ha ocurrido un problema enviando verificación de correo electrónico a '.$_POST["regEmail"].$mail->ErrorInfo.'!",
									  type:"error",
									  confirmButtonText: "Cerrar",
									  closeOnConfirm: false
									},

									function(isConfirm){

										if(isConfirm){
											history.back();
										}
								});

							</script>';

						}else{

							echo '<script> 

								swal({
									  title: "¡TU REGISTRO FUE REALIZADO!",
									  text: "Ahora, revise la bandeja de entrada o la carpeta de SPAM de tu correo electrónico '.$_POST["regEmail"].' para activar tu cuenta!",
									  type:"success",
									  confirmButtonText: "Cerrar",
									  closeOnConfirm: false
									},

									function(isConfirm){

										if(isConfirm){
											window.location = "login";
										}
								});

							</script>';

						}

					}

				}else{

					echo '<script> 

							swal({
								  title: "¡ERROR!",
								  text: "¡Error al registrar el usuario, no se permiten caracteres especiales!",
								  type:"error",
								  confirmButtonText: "Cerrar",
								  closeOnConfirm: false
								},

								function(isConfirm){

									if(isConfirm){
										history.back();
									}
							});

					</script>';

				}

			}else{
    			echo '<script> 

							swal({
								  title: "¡ERROR!",
								  text: "¡Error al captcha registrar el usuario, no se permiten caracteres especiales!",
								  type:"error",
								  confirmButtonText: "Cerrar",
								  closeOnConfirm: false
								},

								function(isConfirm){

									if(isConfirm){
										history.back();
									}
							});

					</script>';	

			}


		}

	}



	/*=============================================
	INGRESO LOGIN DE USUARIO
	=============================================*/

	public function ctrIngresoUsuario(){

		if(isset($_POST["ingEmail"])){

			$key = "6Lc_psoZAAAAAOe3UGE_S9bICY2qZIOvm3zFiLJK";
			$respuesta = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$key."&response=".$_POST['g-recaptcha-response']);
			$respuestac = json_decode($respuesta, true);
		  if($respuestac['success'] == true){
    	
					if(preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["ingEmail"]) &&
					   preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingPassword"])){
					   

					  $encriptar = crypt($_POST["ingPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$
					   		$2a$07$asxx54ahjppf45sd87a5auxq/SS293XhTEeizKWMnfhnpfay0AALe');
								
						$tabla = "profesionales";
						$item = "email";
						$valor = $_POST["ingEmail"];

						$respuesta = ModeloUsuarios::mdlMostrarUsuarios($tabla, $item, $valor);

						if($respuesta["email"] == $_POST["ingEmail"] && $respuesta["password"] == $encriptar){

							if($respuesta["estado"] == 1 && $respuesta["verificacion"] == 1){

								$_SESSION["validarSesionUsuario"] = "okchina";
								$_SESSION["id"] = $respuesta["id"];
								$_SESSION["nombre"] = $respuesta["nomap"];
								$_SESSION["telefono"] = $respuesta["telefono"];
								$_SESSION["foto"] = $respuesta["foto"];
								$_SESSION["email"] = $respuesta["email"];
								$_SESSION["password"] = $respuesta["password"];
								$_SESSION["modo"] = "directo";

								echo '<script>

									window.location = "inicio";

								</script>';

							}else{

								echo '<br>
								<div class="alert alert-warning">Este usuario aún no está activado</div>';	

							}

						}else{

							echo '<br>
							<div class="alert alert-danger">Error al ingresar vuelva a intentarlo</div>';

						}


					}

		  }else{
    			echo '<br>
						<div class="alert alert-warning">Error en Captcha</div>';	

			}

		}

	}

	/*=============================================
	MOSTRAR USUARIO
	=============================================*/

	static public function ctrMostrarUsuario($item, $valor){

		$tabla = "profesionales";

		$respuesta = ModeloUsuarios::mdlMostrarUsuario($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	ACTUALIZAR USUARIO
	=============================================*/

	static public function ctrActualizarUsuario($id, $item, $valor){

		$tabla = "profesionales";

		$respuesta = ModeloUsuarios::mdlActualizarUsuario($tabla, $id, $item, $valor);

		return $respuesta;

	}


	/*=============================================
	OLVIDO DE CONTRASEÑA
	=============================================*/

	public function ctrOlvidoPassword(){

		if(isset($_POST["passEmail"])){

			if(preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["passEmail"])){

				/*=============================================
				GENERAR CONTRASEÑA ALEATORIA
				=============================================*/

				function generarPassword($longitud){

					$key = "";
					$pattern = "1234567890abcdefghijklmnopqrstuvwxyz";

					$max = strlen($pattern)-1;

					for($i = 0; $i < $longitud; $i++){

						$key .= $pattern{mt_rand(0,$max)};

					}

					return $key;

				}

				$nuevaPassword = generarPassword(11);

				$encriptar = crypt($nuevaPassword, '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$
				   		$2a$07$asxx54ahjppf45sd87a5auxq/SS293XhTEeizKWMnfhnpfay0AALe');

				$tabla = "profesionales";

				$item1 = "email";
				$valor1 = $_POST["passEmail"];

				$respuesta1 = ModeloUsuarios::mdlMostrarUsuario($tabla, $item1, $valor1);

				if($respuesta1){

					$id = $respuesta1["id"];
					$item2 = "password";
					$valor2 = $encriptar;

					$respuesta2 = ModeloUsuarios::mdlActualizarUsuario($tabla, $id, $item2, $valor2);

					if($respuesta2  == "ok"){

						/*=============================================
						CAMBIO DE CONTRASEÑA
						=============================================*/

						date_default_timezone_set("America/Lima");

						$url = Ruta::ctrRuta();	

						$mail = new PHPMailer;

						$mail->CharSet = 'UTF-8';

						$mail->isMail();

						$mail->setFrom('registro@medic-portal.com', 'MEDIC PORTAL');

						$mail->addReplyTo('registro@medic-portal.com', 'MEDIC PORTAL');

						$mail->Subject = "Solicitud de nueva contraseña";

						$mail->addAddress($_POST["passEmail"]);

						$mail->msgHTML('<div style="width:100%; background:#eee; position:relative; font-family:sans-serif; padding-bottom:40px">
	
								<center>
									
									<img style="padding:20px; width:10%" src="http://www.medic-portal.com/usuario/vistas/img/medicportal.jpg">

								</center>

								<div style="position:relative; margin:auto; width:600px; background:white; padding:20px">
								
									<center>
									
									<img style="padding:20px; width:15%" src="http://www.medic-portal.com/usuario/vistas/img/icon-email.png">

									<h3 style="font-weight:100; color:#999">SOLICITUD DE NUEVA CONTRASEÑA</h3>

									<hr style="border:1px solid #ccc; width:80%">

									<h4 style="font-weight:100; color:#999; padding:0 20px"><strong>Su nueva contraseña: </strong>'.$nuevaPassword.'</h4>

									<a href="'.$url.'" target="_blank" style="text-decoration:none">

									<div style="line-height:60px; background:#0aa; width:60%; color:white">Ingrese nuevamente al sitio</div>

									</a>

									<br>

									<hr style="border:1px solid #ccc; width:80%">

									<h5 style="font-weight:100; color:#999">Si no se inscribió en esta cuenta, puede ignorar este correo electrónico y la cuenta se eliminará.</h5>

									</center>

								</div>

							</div>');

						$envio = $mail->Send();

						if(!$envio){

							echo '<script> 

								swal({
									  title: "¡ERROR!",
									  text: "¡Ha ocurrido un problema enviando cambio de contraseña a '.$_POST["passEmail"].$mail->ErrorInfo.'!",
									  type:"error",
									  confirmButtonText: "Cerrar",
									  closeOnConfirm: false
									},

									function(isConfirm){

										if(isConfirm){
											history.back();
										}
								});

							</script>';

						}else{

							echo '<script> 

								swal({
									  title: "¡OK!",
									  text: "¡Por favor revise la bandeja de entrada o la carpeta de SPAM de su correo electrónico '.$_POST["passEmail"].' para su cambio de contraseña!",
									  type:"success",
									  confirmButtonText: "Cerrar",
									  closeOnConfirm: false
									},

									function(isConfirm){

										if(isConfirm){
											history.back();
										}
								});

							</script>';

						}

					}

				}else{

					echo '<script> 

						swal({
							  title: "¡ERROR!",
							  text: "¡El correo electrónico no existe en el sistema!",
							  type:"error",
							  confirmButtonText: "Cerrar",
							  closeOnConfirm: false
							},

							function(isConfirm){

								if(isConfirm){
									history.back();
								}
						});

					</script>';


				}

			}else{

				echo '<script> 

						swal({
							  title: "¡ERROR!",
							  text: "¡Error al enviar el correo electrónico, está mal escrito!",
							  type:"error",
							  confirmButtonText: "Cerrar",
							  closeOnConfirm: false
							},

							function(isConfirm){

								if(isConfirm){
									history.back();
								}
						});

				</script>';

			}

		}

	}


}