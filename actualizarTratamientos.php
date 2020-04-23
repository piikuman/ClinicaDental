<?php	
	session_start();	
	
	if (isset($_SESSION["tratamiento"])) {
		$tratamiento = $_SESSION["tratamiento"];
		unset($_SESSION["tratamiento"]);
		
		require_once("gestionBD.php");
		require_once("gestionarTratameintos.php");
		
		$conexion = crearConexionBD();		
		$excepcion = actualizarTratamientos($conexion,$tratamiento);
		cerrarConexionBD($conexion);
			
		if ($excepcion<>"") {
			$_SESSION["excepcion"] = $excepcion;
			$_SESSION["destino"] = "listaTratamientos.php";
			Header("Location: excepcion.php");
		}
		else
			Header("Location: listaTratamientos.php");
	} 
	else Header("Location: mostrarTratamientos.php");
?>