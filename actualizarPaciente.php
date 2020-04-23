<?php	
	session_start();	
	
	if (isset($_SESSION["paciente"])) {
		$paciente = $_SESSION["paciente"];
		unset($_SESSION["paciente"]);
		
		require_once("gestionBD.php");
		require_once("gestionarPaciente.php");
		
		$conexion = crearConexionBD();		
		$excepcion = actualizarPaciente($conexion,$paciente);
		cerrarConexionBD($conexion);
			
		if ($excepcion<>"") {
			$_SESSION["excepcion"] = $excepcion;
			$_SESSION["destino"] = "listaPaciente.php";
			Header("Location: excepcion.php");
		}
		else
			Header("Location: listaPaciente.php");
	} 
	else Header("Location: mostrarPaciente.php");
?>