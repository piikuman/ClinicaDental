<?php
	session_start();

	if (isset($_SESSION["formulario"])) {
		$nuevoUsuario["nombre"] = $_REQUEST["nombre"];
		$nuevoUsuario["apellidos"] = $_REQUEST["apellidos"];
		$nuevoUsuario["dni"] = $_REQUEST["dni"];
		$nuevoUsuario["direccion"] = $_REQUEST["direccion"];
		$nuevoUsuario["poblacion"] = $_REQUEST["poblacion"];
		$nuevoUsuario["fechaNacimiento"] = $_REQUEST["fechaNacimiento"];
		$nuevoUsuario["fechaAlta"] = $_REQUEST["fechaAlta"];
		$nuevoUsuario["telefono"] = $_REQUEST["telefono"];
		$nuevoUsuario["sueldo"] = $_REQUEST["sueldo"];
		
	}
	else Header("Location: formularioDoctora.php");

	$_SESSION["formulario"] = $nuevoUsuario;

	$errores = validarDatosUsuario($nuevoUsuario);
	
	if (count($errores)>0) {
		$_SESSION["errores"] = $errores;
		Header('Location: formularioDoctora.php');
	} else Header('Location: altaDoctora.php');

	function validarDatosUsuario($nuevoUsuario){
		
		if($nuevoUsuario["dni"]=="") 
			$errores[] = "<p>El NIF no puede estar vacío</p>";
		else if(!preg_match("/^[0-9]{8}[A-Z]$/", $nuevoUsuario["dni"])){
			$errores[] = "<p>El DNI debe contener 8 números y una letra mayúscula: " . $nuevoUsuario["dni"]. "</p>";
		}	
			
		if($nuevoUsuario["nombre"]=="") 
			$errores[] = "<p>El nombre no puede estar vacío</p>";
			
		if($nuevoUsuario["apellidos"]=="") 
			$errores[] = "<p>Los apellidos no puede estar vacío</p>";	
	
		return $errores;
	}

?>