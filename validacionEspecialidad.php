<?php
	session_start();

	if(isset($_REQUEST['OID_ESPECIALIDAD'])){
		$especialidad["OID_ESPECIALIDAD"] = $_REQUEST["OID_ESPECIALIDAD"];
		$especialidad["nombre"] = $_REQUEST["nombre"];
		
		
		$_SESSION["especialidad"] = $especialidad;
		
	}else if (isset($_SESSION["formulario"])) {
		$especialidad["nombre"] = $_REQUEST["nombre"];
		
		$_SESSION["formulario"] = $especialidad;
	
	}
	else Header("Location: formularioEspecialidad.php");

	$errores = validarDatosEspecialidad($especialidad);
	
	if (count($errores)>0) {
		$_SESSION["errores"] = $errores;
		Header('Location: formularioEspecialidad.php');
	} else {
		if (isset($_REQUEST["actualizar"])) Header("Location: actualizarEspecialidad.php");
		else if (isset($_REQUEST["añadir"])) Header('Location: altaEspecialidad.php');
	}
	
	function validarDatosEspecialidad($especialidad){
		$errores=array();
		
		if($especialidad["nombre"]=="") 
			$errores[] = "<p>El nombre de la especialidad no puede estar vacio</p>";

		return $errores;
	}
?>