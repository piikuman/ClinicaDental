<?php	
	session_start();	
	
	if (isset($_SESSION["usuario"])) {
		$usuario = $_SESSION["usuario"];
		unset($_SESSION["usuario"]);
		
		require_once("gestionBD.php");
		require_once("gestionarUsuario.php");
		
		$conexion = crearConexionBD();		
		$excepcion = eliminarUsuario($conexion,$usuario["OID_USUARIO"]);
		cerrarConexionBD($conexion);
			
		if ($excepcion<>"") {
			$_SESSION["excepcion"] = $excepcion;
			$_SESSION["destino"] = "administracion.php";
			Header("Location: excepcion.php");
		}
		else Header("Location: administracion.php");
	}
	else Header("Location: administracion.php");
?>