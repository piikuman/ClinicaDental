<?php
	session_start();

	if(isset($_REQUEST['OID_TRATAMIENTO'])){
		$tratamiento["OID_TRATAMIENTO"] = $_REQUEST["OID_TRATAMIENTO"];
		$tratamiento["nombre"] = $_REQUEST["nombre"];
		$tratamiento["coste"] = $_REQUEST["coste"];
		$tratamiento["especialidad"] = $_REQUEST["especialidad"];
		
		$_SESSION["tratamiento"] = $tratamiento;
		
	}else if (isset($_SESSION["formularioTratamiento"])) {
		$tratamiento["nombre"] = $_REQUEST["nombre"];
		$tratamiento["coste"] = $_REQUEST["coste"];
		$tratamiento["especialidad"] = $_REQUEST["especialidad"];

		$_SESSION["formularioTratamiento"] = $tratamiento;
	
	}
	else Header("Location: formularioTratamientos.php");

	$errores = validarDatosTratamiento($tratamiento);
	
	if (count($errores)>0) {
		$_SESSION["errores"] = $errores;
		Header('Location: formularioTratamientos.php');
	} else {
		if (isset($_REQUEST["actualizar"])) Header("Location: actualizarTratamientos.php");
		else if (isset($_REQUEST["añadir"])) Header('Location: altaTratamientos.php');
	}
	
	function validarDatosTratamiento($nuevoTratamiento){
		$errores=array();
		
		if($nuevoTratamiento["nombre"]=="") 
			$errores[] = "<p>El nombre del tratamientos no puede estar vacio</p>";
			
		if($nuevoTratamiento["coste"]=="") 
			$errores[] = "<p>El coste del tratamiento no puede estar vacio</p>";

	
		return $errores;
	}

?>