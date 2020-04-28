<?php	
	session_start();	
	
	if (isset($_SESSION["especialidad"])) {
		$especialidad = $_SESSION["especialidad"];
		unset($_SESSION["especialidad"]);
		
		require_once("gestionBD.php");
		require_once("gestionarEspecialidad.php");
		
		$conexion = crearConexionBD();		
		$excepcion = actualizarEspecialidad($conexion,$especialidad);
		cerrarConexionBD($conexion);
			
		if ($excepcion<>"") {
			$_SESSION["excepcion"] = $excepcion;
			$_SESSION["destino"] = "listaEspecialidad.php";
			Header("Location: excepcion.php");
		}
		else
			Header("Location: listaEspecialidad.php");
	} 
	else Header("Location: mostrarEspecialidad.php");
?>