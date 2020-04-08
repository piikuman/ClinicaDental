<?php	
	session_start();	
	
	if (isset($_SESSION["paciente"])) {
		$libro = $_SESSION["paciente"];
		unset($_SESSION["paciente"]);
		
		require_once("gestionBD.php");
		require_once("gestionarPaciente.php");
		
		$conexion = crearConexionBD();		
		$excepcion = quitar_libro($conexion,$libro["OID_PACIENTE"]);
		cerrarConexionBD($conexion);
			
		if ($excepcion<>"") {
			$_SESSION["excepcion"] = $excepcion;
			$_SESSION["destino"] = "listaPaciente.php";
			Header("Location: excepcion.php");
		}
		else Header("Location: listaPaciente.php");
	}
	else Header("Location: listaPaciente.php");
?>