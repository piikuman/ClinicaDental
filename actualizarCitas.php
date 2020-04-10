<?php	
	session_start();	
	
	if (isset($_SESSION["cita"])) {
		$cita = $_SESSION["cita"];
		unset($_SESSION["cita"]);
		
		require_once("gestionBD.php");
		require_once("gestionarCitas.php");
		
		$conexion = crearConexionBD();		
		$excepcion = actualizarCita($conexion,$cita);
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