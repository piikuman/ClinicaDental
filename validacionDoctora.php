<?php
	session_start();

	if(isset($_REQUEST['OID_DOCTORA'])){
		$doctora["dni"] = $_REQUEST["dni"];
		$doctora["nombre"] = $_REQUEST["nombre"];
		$doctora["apellidos"] = $_REQUEST["apellidos"];
		$doctora["fechaNacimiento"] = $_REQUEST["fechaNacimiento"];
		$doctora["sueldo"] = $_REQUEST["sueldo"];
		$doctora["poblacion"] = $_REQUEST["poblacion"];
		$doctora["direccion"] = $_REQUEST["direccion"];
		$doctora["fechaAlta"] = $_REQUEST["fechaAlta"];
		$doctora["telefono"] = $_REQUEST["telefono"];
		$doctora["especialidad"] = $_REQUEST["especialidad"];
		$doctora["OID_DOCTORA"] = $_REQUEST["OID_DOCTORA"];
		
		$_SESSION["doctora"] = $doctora;
		
	}else if (isset($_SESSION["formularioDoctora"])) {
		$doctora["dni"] = $_REQUEST["dni"];
		$doctora["nombre"] = $_REQUEST["nombre"];
		$doctora["apellidos"] = $_REQUEST["apellidos"];
		$doctora["fechaNacimiento"] = $_REQUEST["fechaNacimiento"];
		$doctora["sueldo"] = $_REQUEST["sueldo"];
		$doctora["poblacion"] = $_REQUEST["poblacion"];
		$doctora["direccion"] = $_REQUEST["direccion"];
		$doctora["fechaAlta"] = $_REQUEST["fechaAlta"];
		$doctora["telefono"] = $_REQUEST["telefono"];
		$doctora["codigoDoctora"] = $_REQUEST["codigoDoctora"];
		$doctora["especialidad"] = $_REQUEST["especialidad"];
		
		$_SESSION["formularioDoctora"] = $doctora;
	
	}
	else Header("Location: formularioDoctora.php");

	$errores = validarDatosDoctora($doctora);
	
	if(isset($_REQUEST["cancelarAñadir"])) header("Location: listaDoctora.php");
	else{
	if (count($errores)>0) {
		$_SESSION["errores"] = $errores;
		Header('Location: formularioDoctora.php');
	} else {
		if (isset($_REQUEST["actualizar"])) Header("Location: actualizarDoctora.php");
		else if (isset($_REQUEST["añadir"])) Header('Location: altaDoctora.php');
	}
	}
	
	function validarDatosDoctora($doctora){
		
		if($doctora["dni"]=="") 
			$errores[] = "<p>El DNI no puede estar vacío</p>";
		else if(!preg_match("/^[0-9]{8}[A-Z]$/", $doctora["dni"])){
			$errores[] = "<p>El DNI debe contener 8 números y una letra mayúscula: " . $doctora["dni"]. "</p>";
		}	
			
		if($doctora["nombre"]=="") 
			$errores[] = "<p>El nombre no puede estar vacío</p>";
			
		if($doctora["apellidos"]=="") 
			$errores[] = "<p>Los apellidos no puede estar vacío</p>";	
	
		return $errores;
	}

?>