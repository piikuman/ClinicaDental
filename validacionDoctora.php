<?php
	session_start();

	if(isset($_REQUEST['OID_DOCTORA'])){
		$paciente["OID_DOCTORA"] = $_REQUEST["OID_DOCTORA"];
		$paciente["dni"] = $_REQUEST["dni"];
		$paciente["nombre"] = $_REQUEST["nombre"];
		$paciente["apellidos"] = $_REQUEST["apellidos"];
		$paciente["fechaNacimiento"] = $_REQUEST["fechaNacimiento"];
		$paciente["sueldo"] = $_REQUEST["sueldo"];
		$paciente["poblacion"] = $_REQUEST["poblacion"];
		$paciente["direccion"] = $_REQUEST["direccion"];
		$paciente["fechaAlta"] = $_REQUEST["fechaAlta"];
		$paciente["telefono"] = $_REQUEST["telefono"];
		$paciente["codigoDoctora"] = $_REQUEST["codigoDoctora"];
		
		$_SESSION["doctora"] = $doctora;
		
	}else if (isset($_SESSION["formulario"])) {
		$paciente["dni"] = $_REQUEST["dni"];
		$paciente["nombre"] = $_REQUEST["nombre"];
		$paciente["apellidos"] = $_REQUEST["apellidos"];
		$paciente["fechaNacimiento"] = $_REQUEST["fechaNacimiento"];
		$paciente["sueldo"] = $_REQUEST["sueldo"];
		$paciente["poblacion"] = $_REQUEST["poblacion"];
		$paciente["direccion"] = $_REQUEST["direccion"];
		$paciente["fechaAlta"] = $_REQUEST["fechaAlta"];
		$paciente["telefono"] = $_REQUEST["telefono"];
		$paciente["codigoDoctora"] = $_REQUEST["codigoDoctora"];
		
		$_SESSION["formulario"] = $doctora;
	
	}
	else Header("Location: formularioDoctora.php");

	$errores = validarDatosUsuario($doctora);
	
	if (count($errores)>0) {
		$_SESSION["errores"] = $errores;
		Header('Location: formularioDoctora.php');
	} else {
		if (isset($_REQUEST["actualizar"])) Header("Location: actualizarDoctora.php");
		else if (isset($_REQUEST["añadir"])) Header('Location: altaDoctora.php');
	}
	
	function validarDatosUsuario($doctora){
		
		if($doctora["dni"]=="") 
			$errores[] = "<p>El DNI no puede estar vacío</p>";
		else if(!preg_match("/^[0-9]{8}[A-Z]$/", $paciente["dni"])){
			$errores[] = "<p>El DNI debe contener 8 números y una letra mayúscula: " . $doctora["dni"]. "</p>";
		}	
			
		if($doctora["nombre"]=="") 
			$errores[] = "<p>El nombre no puede estar vacío</p>";
			
		if($doctora["apellidos"]=="") 
			$errores[] = "<p>Los apellidos no puede estar vacío</p>";	
	
		return $errores;
	}

?>