<?php	
	session_start();	
	
	if (isset($_SESSION["tratamiento"])) {
		$tratamiento = $_SESSION["tratamiento"];
		unset($_SESSION["tratamiento"]);
		
		require_once("gestionBD.php");
		require_once("gestionarTratamientos.php");
		
		$conexion = crearConexionBD();		
		$excepcion = quitar_tratamiento($conexion,$tratamiento["OID_TRATAMIENTO"]);
		cerrarConexionBD($conexion);
			
		if ($excepcion<>"") {
			$_SESSION["excepcion"] = $excepcion;
			$_SESSION["destino"] = "listaTratamientos.php";
			Header("Location: excepcion.php");
		}
		else Header("Location: listaTratameientos.php");
	}
	else Header("Location: listaTratamientos.php");
?>