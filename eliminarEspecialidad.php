<?php	
	session_start();	
	
	if (isset($_SESSION["especialidad"])) {
		$especialidad = $_SESSION["especialidad"];
		unset($_SESSION["especialidad"]);
		
		require_once("gestionBD.php");
		require_once("gestionarTratamientos.php");
		
		$conexion = crearConexionBD();		
		$excepcion = eliminarEspecialidad($conexion,$especialidad["OID_ESPECIALIDAD"]);
		cerrarConexionBD($conexion);
			
		if ($excepcion<>"") {
			$_SESSION["excepcion"] = $excepcion;
			$_SESSION["destino"] = "listaEspecialidad.php";
			Header("Location: excepcion.php");
		}
		else Header("Location: listaEspecialidad.php");
	}
	else Header("Location: listaEspecialidad.php");
?>