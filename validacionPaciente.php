<?php
session_start();

$poblaciones=array('CD' => 'Cádiz', 'SV' => 'Sevilla', 'MA'=>'Málaga', 'HU' => 'Huelva', 'CO'=>'Córdoba', 
					'JA'=>'Jaén', 'AL'=>'Almería', 'GR'=>'Granada', 'OT'=>'Otro');

//Comprobamos que hemos llegado a esta página porque se ha rellenado el formulario
if (isset($_SESSION["formulario"])) {
	// Recogemos los datos del formulario
	$nuevoUsuario["nif"] = $_REQUEST["nif"];
	$nuevoUsuario["nombre"] = $_REQUEST["nombre"];
	$nuevoUsuario["apellidos"] = $_REQUEST["apellidos"];
	$nuevoUsuario["correo"] = $_REQUEST["correo"];
	$nuevoUsuario["seguro"] = $_REQUEST["seguro"];
	$nuevoUsuario["fechaNacimiento"] = $_REQUEST["fechaNacimiento"];
	$nuevoUsuario["fechaAlta"] = $_REQUEST["fechaAlta"];
	$nuevoUsuario["pass"] = $_REQUEST["pass"];
	$nuevoUsuario["confirmpass"] = $_REQUEST["confirmpass"];
	$nuevoUsuario["poblacion"] = $_REQUEST["poblacion"];
	$nuevoUsuario["direccion"] = $_REQUEST["direccion"];
	$nuevoUsuario["nombreTutor"] = $_REQUEST["nombreTutor"];
	$nuevoUsuario["telefonoTutor"] = $_REQUEST["telefonoTutor"];
}
	else // En caso contrario, vamos al formulario
		Header("Location: formularioPaciente.php");
		
	// Guardar la variable local con los datos del formulario en la sesión.
	$_SESSION["formulario"] = $nuevoUsuario;
	
	// Validamos el formulario en servidor 
	$errores = validarDatosUsuario($nuevoUsuario);
	
	// Si se han detectado errores
	if (count($errores)>0) {
		// Guardo en la sesión los mensajes de error y volvemos al formulario
		$_SESSION["errores"] = $errores;
		Header('Location: formularioPaciente.php');
	} else
	// Si todo va bien, vamos a la página de éxito (inserción del usuario en la base de datos)
	Header('Location: altaPaciente.php');
		
	///////////////////////////////////////////////////////////
	// Validación en servidor del formulario de alta de usuario
	///////////////////////////////////////////////////////////
	function validarDatosUsuario($nuevoUsuario){
		// Validación del NIF
		if($nuevoUsuario["nif"]=="") 
			$errores[] = "<p>El NIF no puede estar vacío</p>";
		else if(!preg_match("/^[0-9]{8}[A-Z]$/", $nuevoUsuario["nif"])){
			$errores[] = "<p>El NIF debe contener 8 números y una letra mayúscula: " . $nuevoUsuario["nif"]. "</p>";
		}

		// Validación del Nombre			
		if($nuevoUsuario["nombre"]=="") 
			$errores[] = "<p>El nombre no puede estar vacío</p>";
	
		// Validación del email
		if($nuevoUsuario["correo"]==""){ 
			$errores[] = "<p>El email no puede estar vacío</p>";
		}else if(!filter_var($nuevoUsuario["correo"], FILTER_VALIDATE_EMAIL)){
			$errores[] = $error . "<p>El email es incorrecto: " . $nuevoUsuario["correo"]. "</p>";
		}
		
		// Validación del seguro
		if($nuevoUsuario["seguro"] != "Privado" &&
			$nuevoUsuario["seguro"] != "Publico") {
			$errores[] = "<p>El seguro debe ser privado o público</p>";
		}
		
		// Validación de la contraseña
		if(!isset($nuevoUsuario["pass"]) || strlen($nuevoUsuario["pass"])<8){
			$errores [] = "<p>Contraseña no válida: debe tener al menos 8 caracteres</p>";
		}else if(!preg_match("/[a-z]+/", $nuevoUsuario["pass"]) || 
			!preg_match("/[A-Z]+/", $nuevoUsuario["pass"]) || !preg_match("/[0-9]+/", $nuevoUsuario["pass"])){
			$errores[] = "<p>Contraseña no válida: debe contener letras mayúsculas y minúsculas y dígitos</p>";
		}else if($nuevoUsuario["pass"] != $nuevoUsuario["confirmpass"]){
			$errores[] = "<p>La confirmación de contraseña no coincide con la contraseña</p>";
		}
	
		return $errores;
	}
?>