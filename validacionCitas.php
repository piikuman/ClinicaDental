<?php
	session_start();

	if (isset($_SESSION["formulario"])) {
		$nuevaCita["fechaCita"] = $_REQUEST["fechaCita"];
		$nuevaCita["horaCita"] = $_REQUEST["horaCita"];
		$nuevaCita["consulta"] = $_REQUEST["consulta"];
	}
	else Header("Location: formularioCitas.php");

	$_SESSION["formulario"] = $nuevaCita;

	$errores = validarDatosCita($nuevaCita);
	
	if (count($errores)>0) {
		$_SESSION["errores"] = $errores;
		Header('Location: formularioCitas.php');
	} else Header('Location: altaCitas.php');

	function validarDatosCita($nuevaCita){
		
		if($nuevaCita["fechaCita"]=="") 
			$errores[] = "<p>La fecha de la cita no puede estar vacia</p>";
			
		if($nuevaCita["horaCita"]=="") 
			$errores[] = "<p>La hora de la cita no puede estar vacia</p>";
			
		if($nuevaCita["consulta"]=="") 
			$errores[] = "<p>Debe proporcionar una consulta a la cita</p>";	
	
		return $errores;
	}

?>