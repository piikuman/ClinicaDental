<?php
	session_start();

	if (isset($_SESSION["formulario"])) {
		$nuevoTratamiento["nombre"] = $_REQUEST["nombre"];
		$nuevoTratamiento["coste"] = $_REQUEST["coste"];
	}
	else Header("Location: formularioTratamientos.php");

	$_SESSION["formulario"] = $nuevoTratamiento;

	$errores = validarDatosTratamiento($nuevoTratamiento);
	
	if (count($errores)>0) {
		$_SESSION["errores"] = $errores;
		Header('Location: formularioTratamientos.php');
	} else Header('Location: altaTratamientos.php');

	function validarDatosTratamiento($nuevoTratamiento){
		
		if($nuevoTratamiento["nombre"]=="") 
			$errores[] = "<p>El nombre del tratamientos no puede estar vacio</p>";
			
		if($nuevoTratamiento["coste"]=="") 
			$errores[] = "<p>El coste del tratamiento no puede estar vacio</p>";

	
		return $errores;
	}

?>