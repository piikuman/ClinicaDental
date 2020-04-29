<?php
	session_start();

	if(isset($_REQUEST['OID_PACIENTE'])){
		
		$paciente["OID_PACIENTE"] = $_REQUEST["OID_PACIENTE"];
		$paciente["dni"] = $_REQUEST["dni"];
		$paciente["nombre"] = $_REQUEST["nombre"];
		$paciente["apellidos"] = $_REQUEST["apellidos"];
		$paciente["fechaNacimiento"] = $_REQUEST["fechaNacimiento"];
		$paciente["correo"] = $_REQUEST["correo"];
		$paciente["poblacion"] = $_REQUEST["poblacion"];
		$paciente["direccion"] = $_REQUEST["direccion"];
		$paciente["fechaAlta"] = $_REQUEST["fechaAlta"];
		$paciente["seguro"] = $_REQUEST["seguro"];
		$paciente["nombreTutor"] = $_REQUEST["nombreTutor"];
		$paciente["telefonoTutor"] = $_REQUEST["telefonoTutor"];
		
		$_SESSION["paciente"] = $paciente;
		
	}else if (isset($_SESSION["formularioPaciente"])) {
		$paciente["dni"] = $_REQUEST["dni"];
		$paciente["nombre"] = $_REQUEST["nombre"];
		$paciente["apellidos"] = $_REQUEST["apellidos"];
		$paciente["fechaNacimiento"] = $_REQUEST["fechaNacimiento"];
		$paciente["correo"] = $_REQUEST["correo"];
		$paciente["poblacion"] = $_REQUEST["poblacion"];
		$paciente["direccion"] = $_REQUEST["direccion"];
		$paciente["fechaAlta"] = $_REQUEST["fechaAlta"];
		$paciente["seguro"] = $_REQUEST["seguro"];
		$paciente["nombreTutor"] = $_REQUEST["nombreTutor"];
		$paciente["telefonoTutor"] = $_REQUEST["telefonoTutor"];
		
		$_SESSION["formularioPaciente"] = $paciente;
	
	}
	else Header("Location: formularioPaciente.php");

	$errores = validarDatosUsuario($paciente);
	
	if (count($errores)>0) {
		$_SESSION["errores"] = $errores;
		Header('Location: formularioPaciente.php');
	} else {
		if (isset($_REQUEST["actualizar"])) Header("Location: actualizarPaciente.php");
		else if (isset($_REQUEST["añadir"])) Header('Location: altaPaciente.php');
	}
	
	function validarDatosUsuario($paciente){
		$errores=array();
		
		if($paciente["dni"]=="") 
			$errores[] = "<p>El DNI no puede estar vacío</p>";
		else if(!preg_match("/^[0-9]{8}[A-Z]$/", $paciente["dni"])){
			$errores[] = "<p>El DNI debe contener 8 números y una letra mayúscula: " . $paciente["dni"]. "</p>";
		}
			
		if($paciente["nombre"]=="") 
			$errores[] = "<p>El nombre no puede estar vacío</p>";
			
		if($paciente["apellidos"]=="") 
			$errores[] = "<p>Los apellidos no puede estar vacío</p>";	
	
		return $errores;
	}

?>