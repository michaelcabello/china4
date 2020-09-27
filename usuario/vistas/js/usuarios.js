/*=============================================
CAPTURA DE RUTA
=============================================*/

var rutaActual1 = location.href;

$(".btnIngreso").click(function(){

	localStorage.setItem("rutaActual1", rutaActual1);

})
/*=============================================
VALIDAR EMAIL REPETIDOO
=============================================*/

var validarEmailRepetido = false;

$("#regEmail").change(function(){

	var email = $("#regEmail").val();

	var datos = new FormData();
	datos.append("validarEmail", email);

	$.ajax({

		url:"ajax/usuarios.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		success:function(respuesta){
			
			if(respuesta == "false"){

				$(".alert").remove();
				validarEmailRepetido = false;

			}else{

				var modo = JSON.parse(respuesta).modo;
				
				if(modo == "directo"){

					modo = "esta página";
				}

				$("#regEmail").parent().before('<div class="alert alert-warning"><strong>ERROR:</strong> El correo electrónico ya existe en la base de datos, fue registrado a través de '+modo+', por favor ingrese otro diferente</div>')

					validarEmailRepetido = true;

			}

		}

	})

})

/*=============================================
VALIDAR EL REGISTRO DE USUARIO
=============================================*/
function registroUsuario(){

	$(".alert").remove();

	/*=============================================
	VALIDAR EL NOMBRE
	=============================================*/

	var nombre = $("#regUsuario").val();

	if(nombre != ""){

		var expresion = /^[a-zA-ZñÑáéíóúÁÉÍÓÚ. ]*$/;

		if(!expresion.test(nombre)){

			$("#regUsuario").parent().before('<div class="alert alert-warning"><strong>ERROR:</strong> No se permiten números ni caracteres especialess</div>')

			return false;

		}

	}else{

		$("#regUsuario").parent().before('<div class="alert alert-warning"><strong>ATENCIÓN:</strong> Ingrese su Nombre y Apellidos </div>')

		return false;
	}

	/*=============================================
	VALIDAR EL EMAIL
	=============================================*/

	var email = $("#regEmail").val();

	if(email != ""){

		var expresion = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/;

		if(!expresion.test(email)){

			$("#regEmail").parent().before('<div class="alert alert-warning"><strong>ERROR:</strong> Escriba correctamente el correo electrónico</div>')

			return false;

		}

		if(validarEmailRepetido){

			$("#regEmail").parent().before('<div class="alert alert-danger"><strong>ERROR:</strong> El correo electrónico ya existe en la base de datos, por favor ingrese otro diferente</div>')

			return false;

		}

	}else{

		$("#regEmail").parent().before('<div class="alert alert-warning"><strong>ATENCIÓN:</strong> El Email es obligatorio</div>')

		return false;
	}


	/*=============================================
	VALIDAR CONTRASEÑA
	=============================================*/

	var password = $("#regPassword").val();

	if(password != ""){

			var expresion = /^[a-zA-Z0-9]*$/;

			if(!expresion.test(password)){

				$("#regPassword").parent().before('<div class="alert alert-warning"><strong>ERROR:</strong> No se permiten caracteres especiales</div>')

				return false;

			}

	}else{

		$("#regPassword").parent().before('<div class="alert alert-warning"><strong>ATENCIÓN:</strong> El Password es obligatorio</div>')

		return false;
	}


	/*=============================================
	VALIDAR CONTRASEÑA DOS
	=============================================*/


    var passwordd = $("#regPasswordd").val();

	if(passwordd != ""){

			var expresion = /^[a-zA-Z0-9]*$/;

			if(!expresion.test(passwordd)){

				$("#regPasswordd").parent().before('<div class="alert alert-warning"><strong>ERROR:</strong> No se permiten caracteres especiales</div>')

				return false;
			}
			else{
				if(password != passwordd){
					$("#regPasswordd").parent().before('<div class="alert alert-warning"><strong>ERROR:</strong> Los Password no coinciden</div>')
					return false;
				}

			}	


	}else{

		$("#regPasswordd").parent().before('<div class="alert alert-warning"><strong>ATENCIÓN:</strong> El Password es obligatorio</div>')

		return false;
	}


	/*=============================================
	VALIDAR POLÍTICAS DE PRIVACIDAD
	=============================================*/

	var politicas = $("#regPoliticas:checked").val();
	
	if(politicas != "on"){

		$("#regPoliticas").parent().before('<div class="alert alert-warning"><strong>ATENCIÓN:</strong> Debe aceptar nuestras condiciones de uso y políticas de privacidad</div>')

		return false;

	}



	/*=============================================
	VALIDAR RECAPTCHA
	=============================================*/

	var v = grecaptcha.getResponse();
    //console.log("Resp" + v );
    if (v == '') {
        //document.getElementById('captcha').innerHTML = "You can't leave Captcha Code empty";
        $("#captcha").parent().before('<div class="alert alert-warning"><strong>ATENCIÓN:</strong> Demuestra que no eres Robot, Activar el CAPTCHA</div>')
        return false;
            }
    else {
        //document.getElementById('captcha').innerHTML = "Captcha completed";
        return true;
    }

	

	return true;
}