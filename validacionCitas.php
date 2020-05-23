<?php
	session_start();
	
	require_once ('gestionarCitas.php');
	require_once ('gestionarPaciente.php');
	require_once ('gestionarDoctora.php');
	require_once ('gestionarTratamientos.php');
	require_once ('gestionBD.php');

	if(isset($_REQUEST['OID_CITA'])){
		$cita["OID_CITA"] = $_REQUEST["OID_CITA"];
		$cita["fechaCita"] = $_REQUEST["fechaCita"];
		$cita["horaCita"] = $_REQUEST["horaCita"];
		$cita["consulta"] = $_REQUEST["consulta"];
		$cita["paciente"] = $_REQUEST["paciente"];
		$cita["doctora"] = $_REQUEST["doctora"];
		$cita["tratamiento"] = $_REQUEST["tratamiento"];
		
		$_SESSION["cita"] = $cita;
		
	}else if (isset($_SESSION["formularioCita"])) {
		$cita["fechaCita"] = $_REQUEST["fechaCita"];
		$cita["horaCita"] = $_REQUEST["horaCita"];
		$cita["consulta"] = $_REQUEST["consulta"];
		$cita["paciente"] = $_REQUEST["paciente"];
		$cita["doctora"] = $_REQUEST["doctora"];
		$cita["tratamiento"] = $_REQUEST["tratamiento"];

		$_SESSION["formularioCita"] = $cita;
	
	}
	else Header("Location: formularioCitas.php");

	$errores = validarDatosCita($cita);
	
	if(isset($_REQUEST["cancelarAñadir"])) header("Location: listaCitas.php");
	else{
		if (count($errores)>0) {
		$_SESSION["errores"] = $errores;
		Header('Location: formularioCitas.php');
		} else {
		if (isset($_REQUEST["actualizar"])) Header("Location: actualizarCitas.php");
		else if (isset($_REQUEST["añadir"])) Header('Location: altaCitas.php');
		}
	}
	
	
	function validarDatosCita($cita){
		$errores=array();
		
		$conexion = crearConexionBD();
		if(!(isset($cita["OID_CITA"]))){
			$oid = -1;
		}else{
			$oid = $cita["OID_CITA"];
		}
		$totalCitasFecha = validacionCita($conexion,$cita["fechaCita"],$cita["horaCita"],$cita["consulta"],$oid);
		$existePaciente = existePaciente($conexion,$cita["paciente"]);
		$existeTratamiento = existeTratamiento($conexion,$cita["tratamiento"]);
		$existeDoctora = existeDoctora($conexion,$cita["doctora"]);
		cerrarConexionBD($conexion);
		
		if($cita["horaCita"]=="") 
			$errores[] = "<p>La hora de la cita no puede estar vacia</p>";
			
		if($cita["consulta"]=="") 
			$errores[] = "<p>La consulta de la cita no puede estar vacia</p>";	
		
		if($cita["paciente"]==""){
			$errores[] = "<p>El DNI del paciente no puede estar vacio</p>";
		}else if($existePaciente==0){
			$errores[] = "<p>El paciente ingresado no existe</p>";
		}
		
		if($cita["tratamiento"]==""){
			$errores[] = "<p>El nombre del tratamiento no puede estar vacio</p>";
		}else if($existeTratamiento==0){
			$errores[] = "<p>El tratamiento ingresado no existe</p>";
		}
		
		if($cita["doctora"]==""){
			$errores[] = "<p>El código de la doctora no puede estar vacio</p>";
		}else if($existeDoctora==0){
			$errores[] = "<p>El codigo de doctora ingresado no existe</p>";
		}
		
		if($cita["fechaCita"]==""){
			$errores[] = "<p>La fecha de la cita no puede estar vacia</p>";
		}
		
		if($totalCitasFecha!=0){
			$errores[] = "<p>Esta fecha ya está asignada a esta hora y consulta</p>";
		}
	
		return $errores;
	}

?>