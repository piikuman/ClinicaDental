<?php
	session_start();

	if(isset($_REQUEST['OID_CITA'])){
		$cita["OID_CITA"] = $_REQUEST["OID_CITA"];
		$cita["fechaCita"] = $_REQUEST["fechaCita"];
		$cita["horaCita"] = $_REQUEST["horaCita"];
		$cita["consulta"] = $_REQUEST["consulta"];
		
		$_SESSION["cita"] = $cita;
		
	}else if (isset($_SESSION["formulario"])) {
		$cita["fechaCita"] = $_REQUEST["fechaCita"];
		$cita["horaCita"] = $_REQUEST["horaCita"];
		$cita["consulta"] = $_REQUEST["consulta"];

		$_SESSION["formulario"] = $cita;
	
	}
	else Header("Location: formularioCitas.php");

	$errores = validarDatosCita($cita);
	
	if (count($errores)>0) {
		$_SESSION["errores"] = $errores;
		Header('Location: formularioCitas.php');
	} else {
		if (isset($_REQUEST["actualizar"])) Header("Location: actualizarCitas.php");
		else if (isset($_REQUEST["añadir"])) Header('Location: altaCitas.php');
	}
	
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