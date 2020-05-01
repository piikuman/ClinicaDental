<?php	
	session_start();	
	
	if (isset($_SESSION["cita"])) {
		$cita = $_SESSION["cita"];
		unset($_SESSION["cita"]);
		
		require_once("gestionBD.php");
		require_once("gestionarCitas.php");
		require_once("gestionarPaciente.php");
		require_once("gestionarTratamientos.php");
		require_once("gestionarDoctora.php");
		
		$conexion = crearConexionBD();
		$paciente = buscaPaciente($conexion, $cita["paciente"]);
		$doctora = buscaDoctora($conexion, $cita["doctora"]);
		$tratamiento = buscaTratamiento($conexion, $cita["tratamiento"]);		
		$excepcion = actualizarCita($conexion,$cita,$paciente["OID_PACIENTE"],$doctora["OID_DOCTORA"],$tratamiento["OID_TRATAMIENTO"]);
		cerrarConexionBD($conexion);
			
		if ($excepcion<>"") {
			$_SESSION["excepcion"] = $excepcion;
			$_SESSION["destino"] = "listaCitas.php";
			Header("Location: excepcion.php");
		}
		else
			Header("Location: listaCitas.php");
	} 
	else Header("Location: mostrarCita.php");
?>